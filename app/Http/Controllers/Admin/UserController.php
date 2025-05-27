<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
    
        // 🔍 Recherche par nom ou email
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
    
        // 🎭 Filtrer par rôle
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
    
        // 🟢 Filtrer par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // 📄 Pagination
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
    
        // ✅ Vue correcte (pas index)
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
            'status' => 'required|in:actif,inactif',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur ajouté');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'status' => 'required|in:actif,inactif',
        ]);

        $user->update($request->only(['name', 'email', 'role', 'status']));
        
        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour.');
    }
    

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }

    public function export()
    {
        $users = User::all();
    
        $csvData = "ID,Nom,Email,Rôle,Statut,Date d'inscription\n";
        foreach ($users as $user) {
            $csvData .= "{$user->id},{$user->name},{$user->email},{$user->role},{$user->status},{$user->created_at->format('Y-m-d')}\n";
        }
    
        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="utilisateurs.csv"',
        ]);
    }


public function show(User $user)
{
    return view('profile.show', compact('user'));
}
}
