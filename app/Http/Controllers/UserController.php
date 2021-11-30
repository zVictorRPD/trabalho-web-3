<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'), [
            'users' => $users,
        ]);
    }

    public function store(UserFormRequest $request)
    {
        $input = $request->except('_token');

        $input['NM_PSGR'] = strtoupper($input['NM_PSGR']);
        $input['DT_NASC_PSGR'] = implode('/', array_reverse(explode('/', $input['DT_NASC_PSGR'])));

        try {
            DB::beginTransaction();

            User::create($input);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Erro na adição de um Usuário: '.$e->getMessage());
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

    public function update(UserFormRequest $request, $id)
    {
        if(!$user = User::find($id)) {
            return response()->json('Este usuário não existe! Tente recarregar a página.', 404);
        }

        $input = $request->except('_token');

        $input['NM_PSGR'] = strtoupper($input['NM_PSGR']);
        $input['DT_NASC_PSGR'] = implode('/', array_reverse(explode('/', $input['DT_NASC_PSGR'])));

        try {
            DB::beginTransaction();

            $user->update($input);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            return response()->json("Erro na edição do Usuário {$id}: ".$e->getMessage(), 500);
        }

        return response()->json(['message' => 'Usuário atualizado com sucesso', 'user' => $user], 200);
    }

    public function destroy($id)
    {
        if(!$user = User::find($id)) {
            return response()->json('Este usuário não existe! Tente recarregar a página.', 404);
        }

        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            return response()->json("Erro na exclusão do Usuário {$id}: ".$e->getMessage(), 500);
        }

        return response()->json('Usuário excluido com sucesso!', 200);
    }

}
