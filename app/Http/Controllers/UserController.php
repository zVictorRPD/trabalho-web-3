<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
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
        $user->sex_abbrv = $user->sex;

        switch($user->sex_abbrv) {
            case 'M': 
                $user->sex = 'Masculino';
            break;

            case 'F':
                $user->sex = 'Feminino';
            break;

            default: 
                $user->sex = 'Outro';
        }

        $user->birth = Carbon::parse($user->birth)->format('d/m/Y');

        return response()->json($user, 200);
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

            return response()->json(['message' => 'Erro na adição de um Usuário. Tente novamente mais tarde!', 'error' => $e->getMessage()], 500);
        }

        return response()->json([
            'message' => 'Usuário adicionado com sucesso!',
            'redirect' => route('users.index'),
        ], 200);

    }

    public function create()
    {
        return view('users.create');
    }

    public function update(UserFormRequest $request, User $user)
    {
        $input = $request->except('_token', '_method', '_id');

        $input['birth'] = implode('/', array_reverse(explode('/', $input['birth'])));

        if(is_null($input['password'])) unset($input['password']);
        else $input['password'] = bcrypt($input['password']);

        try {
            DB::beginTransaction();

            $user->update($input);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            return response()->json(['message' => "Erro na edição do Usuário {$user->name}. Tente novamente mais tarde!", 'error' => $e->getMessage()], 500);
        }

        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'redirect' => route('users.index'),
        ], 200);
    }

    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            return response()->json(['message' => "Erro na exclusão do Usuário {$id}. Tente novamente mais tarde!", 'error' => $e->getMessage()], 500);
        }

        return response()->json([
            'message' => 'Usuário excluido com sucesso!',
            'redirect' => route('users.index'),
        ], 200);
    }

}
