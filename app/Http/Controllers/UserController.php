<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(UserFormRequest $request)
    {
        $input = $request->except('_token');
        $input['birth'] = implode('-', array_reverse(explode('/', $input['birth'])));
        $input['password'] = bcrypt($input['password']);

        try {
            DB::beginTransaction();

            User::create($input);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro na adição de um Usuário. Tente novamente mais tarde!');
        }
        return redirect()->route('users.index')->with('success', 'Usuário adicionado com sucesso!');

    }

    public function create()
    {
        return view('users.create');
    }

    // show e edit
    public function getUser($id)
    {
        if(!$user = User::find($id)) {
            return response()->json('Este usuário não existe! Tente recarregar a página.', 404);
        }

        return response()->json($user, 200);
    }

    public function update(Request $request, User $user)
    {
        // if(!$user = User::find($id)) {
        //     return back()->with('error', 'Este usuário não existe!');
        // }

        $input = $request->except('_token', '_method', '_id');

        $input['birth'] = implode('/', array_reverse(explode('/', $input['birth'])));
        if(is_null($input['password'])) unset($input['password']);

        $input['password'] = bcrypt($input['password']);

        try {
            DB::beginTransaction();

            $user->update($input);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            return back()->with('error', "Erro na edição do Usuário {$id}. Tente novamente mais tarde!");
        }

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso');
    }

    public function destroy(User $user)
    {
        // if(!$user = User::find($id)) {
        //     return back()->with('error', 'Este usuário não existe!',);
        // }

        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            return back()->with('error', "Erro na exclusão do Usuário {$id}. Tente novamente mais tarde!");
        }

        return redirect()->route('users.index')->with('success', 'Usuário excluido com sucesso!');
    }

}
