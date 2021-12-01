@extends('layouts.main')

@section('title', 'Usuários')

@push('css')

@endpush

@section('container')
    <div class="main-container index-container">

        <div class="d-flex justify-content-start">
            <h1 class="page-title">Usuários</h1>
            <a class="ml-auto" href="{{ route('users.create') }}"><button class="btn-default btn-green mr-4">Cadastrar</button></a>
        </div>

        <div class="main-card blue-card">
            <div class="table-responsive">
                <table id="table-id" class="table table-stripped dt-bootstrap5">
                    <thead>
                        <th class="first-column" style="width:30px">Cód.</th>
                        <th style="width:200px">Nome</th>
                        <th style="width:80px">Nascimento</th>
                        <th style="width:150px">CPF</th>
                        <th style="width:100px">Sexo</th>
                        <th style="width:200px">Email</th>
                        <th class="last-column" style="80px">Ações</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr id="linha-{{ $user->id }}">
                                <td class="first-column">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->birth }}</td>
                                <td>{{ $user->cpf }}</td>
                                <td>{{ $user->sex }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="last-column">
                                    <div class="d-flex justify-content-center">
                                        <button id="edit-{{ $user->id }}" class="icon icon-edit"
                                            data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" form="delete_{{ $user->id }}"
                                            class="icon icon-delete" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form method="POST"
                                            action="{{ route('users.destroy', $user->id) }}"
                                            id="delete_{{ $user->id }}" class="form-delete-client">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- DELETE --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-delete" role="document">
            <div class="modal-content modal-content-delete">
                <div class="modal-header-delete text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        Deletar linha de Usuários
                    </h5>
                </div>

                <div class="modal-body">
                    <p class="modal-text">
                        Deseja realmente deletar o Usuário
                        <span id="delete-code-em"></span>?
                    </p>
                    <div class="btn-div d-flex justify-content-end">
                        <button type="button" class="delete-dismiss btn-default btn-red"
                            data-dismiss="modal">Cancelar</button>
                        <button id="modal-button-delete" type="submit"
                            class="delete-submit btn-default btn-blue ml-4">Deletar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- EDITAR --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-default">
                <div class="modal-header-default text-white">
                    <h5 class="modal-title" id="editModalLabel">
                        Editar tabela de Usuários
                    </h5>
                </div>

                <div class="modal-body">
                    <form id="edit-form" action="" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Nome</label>
                                @error('name')
                                    <small class="text-danger ml-3">{{ $message }}</small>
                                @enderror
                                <input class="register-input" name="name" type="text" placeholder="Insira o nome" value="{{ old('name') }}">

                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Nascimento</label>
                                <input class="register-input date" name="birth" type="text" placeholder="Insira a data de nascimento" value="{{ old('birth') }}">
                                @error('birth')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">CPF</label>
                                <input class="register-input cpf" name="cpf" type="text" placeholder="Insira o cpf" value="{{ old('cpf') }}">
                                @error('cpf')
                                    <small class="text-danger">{{ $message }}o</small>
                                @enderror
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Sexo</label>
                                <div class="custom-select-2">
                                    <select class="register-input" name="sex">
                                        <option value="">Selecione seu sexo</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                        <option value="O">Outros</option>
                                    </select>
                                </div>
                                @error('sex')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Email</label>
                                <input class="register-input" name="email" type="text" placeholder="Insira o email" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Senha</label>
                                <input class="register-input" name="password" type="text" placeholder="Insira a senha" value="{{ old('password') }}">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                        </div>
                        <div class="btn-div d-flex justify-content-end">
                            <button type="button" class="delete-dismiss btn-default btn-red"
                                data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="edit-submit btn-default btn-blue ml-4">Editar</button>
                        </div>
                        @method('PUT');
                        <input type="hidden" name="_id">
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            // $('#table-id').DataTable({
            //     language: {
            //         url: "<?= asset('js/datatable.json') ?>"
            //     }
            // });

            $('.delete-dismiss').on('click', function() {
                $('#deleteModal').modal('hide')
            });

            /* deletar */
            $('.icon-delete').on('click', function() {
                let id = $(this).attr('form').split('_')[1];
                $('#delete-code-em').html($(`#linha-${id}`).children().eq(1).html())
                $("#modal-button-delete").attr('form', $(this).attr('form'));
            });

            /* editar */
            $('.icon-edit').on('click', function() {
                let id = $(this).attr('id').split('-')[1];
                let td_array = $(`#linha-${id}`).children();
                let input_array = $('#edit-form :input');

                $('#edit-form').attr('action', "<?= route('users.update', ['_id_']) ?>".replace('_id_', id));
                // -1 no for pq ignoramos o @crf e o campo com o id
                for (i = 0; i < td_array.length - 2; i++) {
                    if (input_array.eq(i).attr('type') == "hidden") continue;
                    if(input_array.eq(i).attr('type') == undefined){
                        input_array.eq(i).val(td_array.eq(i).html());
                        input_array.eq(i).next().html(td_array.eq(i).html()).addClass('select-item-black');
                    }else{
                        input_array.eq(i).val(td_array.eq(i).html());
                    }
                }

                $('input[name=_id]').val(id);
            });

            $('.custom-select-2').on('click', function() {
                $(this).find('.select-selected').addClass('select-item-black');
            });

            $('.date').mask('00/00/0000');
        });
    </script>

@endpush
