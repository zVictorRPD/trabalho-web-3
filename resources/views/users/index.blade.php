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
                                <td>{{ \Carbon\Carbon::parse($user->birth)->format('d/m/Y') }}</td>
                                <td>{{ $user->cpf }}</td>
                                <td>{{ $user->sex }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="last-column">
                                    <div class="d-flex justify-content-center">
                                        <button id="show-{{ $user->id }}" class="icon icon-show">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </button> 
                                        <button id="edit-{{ $user->id }}" class="icon icon-edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" form="delete_{{ $user->id }}"
                                            class="icon icon-delete" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modals">
        {{-- VISUALIZAR --}}
        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-default">
                    <div class="modal-header-default text-white">
                        <h5 class="modal-title" id="showModalLabel">
                            Detalhes do Usuário
                        </h5>
                    </div>

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Nome</label>
                                <input class="register-input" name="name" type="text" disabled/>
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Nascimento</label>
                                <input class="register-input date" name="birth" type="text" disabled/>
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">CPF</label>
                                <input class="register-input cpf" name="cpf" type="text" disabled/>
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Sexo</label>
                                <input class="register-input sex" name="sex" type="text" disabled/>
                            </div>
                            <div class="col-md-12 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Email</label>
                                <input class="register-input" name="email" type="text" disabled/>
                            </div>
                        </div>
                        <div class="btn-div d-flex justify-content-end">
                            <button type="button" class="show-dismiss btn-default btn-primary">Voltar</button>
                        </div>
                    </div>
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
                            Deletar Usuário
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
                            <button data-id="" id="submit-delete" type="submit"
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
                            Editar Usuário
                        </h5>
                    </div>

                    <div class="modal-body">
                        <div class="form-row">
                            <input type="hidden" name="_id">
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Nome</label>
                                <small id="error-name" class="text-danger ml-3" hidden></small>
                                <input class="register-input" name="name" type="text" placeholder="Insira o nome" value="">

                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Nascimento</label>
                                <input class="register-input date" name="birth" type="text" placeholder="Insira a data de nascimento" value="">
                                <small id="error-birth" class="text-danger" hidden></small>
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">CPF</label>
                                <input class="register-input cpf" name="cpf" type="text" placeholder="Insira o cpf" value="">
                                <small id="error-cpf" class="text-danger" hidden></small>
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
                                <small id="error-sex" class="text-danger" hidden></small>
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Email</label>
                                <input class="register-input" name="email" type="text" placeholder="Insira o email" value="">
                                <small id="error-email" class="text-danger" hidden></small>
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Senha</label><i class="ml-2 fa fa-question-circle-o" data-toggle="tooltip" title="A senha deve conter apenas letras e/ou números. Para manter a mesma senha, não informar nada"></i>
                                <input class="register-input" name="password" type="password" placeholder="Insira a senha para alterar a antiga" value="">
                                <small id="error-password" class="text-danger" hidden></small>
                            </div>
                        </div>
                        <div class="btn-div d-flex justify-content-end">
                            <button type="button" class="edit-dismiss btn-default btn-red"
                                data-dismiss="modal">Cancelar</button>
                            <button id="submit-edit" class="edit-submit btn-default btn-blue ml-4">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('#table-id').DataTable({
                language: {
                    url: "<?= asset('js/datatable.json') ?>"
                }
            });

            $('.show-dismiss').on('click', function() {
                $('#showModal').modal('hide');
            });

            $('.edit-dismiss').on('click', function() {
                $('#editModal').modal('hide');
            });

            $('.delete-dismiss').on('click', function() {
                $('#deleteModal').modal('hide');
            });

            $('.icon-show').on('click', function () {
                const id = this.id.split('-')[1];
                
                $.ajax({
                    method: 'GET',
                    url: "<?= route('users.show', '_user') ?>".replace('_user', id),
                    success(res) {
                        $('#showModal input[name=name]').val(res.name);
                        $('#showModal input[name=cpf]').val(res.cpf);
                        $('#showModal input[name=birth]').val(res.birth);
                        $('#showModal input[name=sex]').val(res.sex);
                        $('#showModal input[name=email]').val(res.email);

                        $('#showModal').modal('show');
                    },
                    error(err) {
                        if(err.status === 404) {
                            new popupAlert('Este usuário não existe! Tente recarregar a página.', 2, 3000).create();
                        } else {
                            console.log(err.responseJSON);
                            new popupAlert('Algo deu errado ao visualizar o usuário. Tente novamente mais tarde!', 2, 3000).create();
                        }
                    }
                });
            });

            /* editar */
            $('.icon-edit').on('click', function() {
                $('#editModal small').prop('hidden', true);
                $('#editModal input[name=password]').val('');

                const id = this.id.split('-')[1];

                $.ajax({
                    method: 'GET',
                    url: "<?= route('users.show', '_user') ?>".replace('_user', id),
                    success(res) {
                        $('#editModal input[name=name]').val(res.name);
                        $('#editModal input[name=cpf]').val(res.cpf);
                        $('#editModal input[name=birth]').val(res.birth);
                        $('#editModal input[name=email]').val(res.email);

                        const select2_div = $('#editModal .custom-select-2');

                        const select2 = {
                            select: select2_div.children().eq(0),
                            container: select2_div.children().eq(1),
                            options: select2_div.children().eq(2).children(),
                        };

                        select2.select.val(res.sex_abbrv);
                        select2.container.html(res.sex);
                        select2.container.addClass('select-item-black');
                        select2.options.removeClass('same-as-selected');

                        switch(res.sex_abbrv) {
                            case 'M': 
                                select2.options.eq(0).addClass('same-as-selected');
                            break;

                            case 'F':
                                select2.options.eq(1).addClass('same-as-selected');
                            break;

                            default: 
                                select2.options.eq(2).addClass('same-as-selected');
                        }

                        $('#editModal').modal('show');
                    },
                    error(err) {
                        if(err.status === 404) {
                            new popupAlert('Este usuário não existe! Tente recarregar a página.', 2, 3000).create();
                        } else {
                            console.log(err.responseJSON);
                            new popupAlert('Algo deu errado ao visualizar o usuário. Tente novamente mais tarde!', 2, 3000).create();
                        }
                    }
                });

                $('input[name=_id]').val(id);
            });

            /* deletar */
            $('.icon-delete').on('click', function() {
                let id = $(this).attr('form').split('_')[1];
                $('#delete-code-em').html($(`#linha-${id}`).children().eq(1).html())
                $("#submit-delete").attr('data-id', id);
            });

            $('#submit-edit').on('click', function () {
                const _id = $('input[name=_id]').val();

                $('#editModal small').prop('hidden', true);

                const btn = $(this);
                btn.html(`<img src="{{ asset('images/icons/loading.gif') }}" alt="Carregando..." width="30">`);

                $.ajax({
                    method: 'POST',
                    url: "<?= route('users.update', '_user') ?>".replace('_user', _id),
                    data: {
                        '_method': 'PUT',
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        _id,
                        name: $('#editModal input[name=name]').val(),
                        cpf: $('#editModal input[name=cpf]').val(),
                        birth: $('#editModal input[name=birth]').val(),
                        sex: $('#editModal select[name=sex]').val(),
                        email: $('#editModal input[name=email]').val(),
                        password: $('#editModal input[name=password]').val()
                    },
                    success(res) {
                        btn.off('click');
                        btn.html('Editado!');

                        new popupAlert(res.message, 1, 3600000).create();

                        setTimeout(() => {
                            location.href = res.redirect;
                        }, 1500);
                    },
                    error(err) {
                        btn.html('Editar');

                        if(err.status === 422) {
                            const errors = err.responseJSON.errors;

                            for(let field in errors) {
                                const error_message = errors[field][0];

                                const error_field = $(`#editModal small#error-${field}`);
                                error_field.html(error_message);
                                error_field.prop('hidden', false);
                            }
                        } else {
                            new popupAlert(err.responseJSON.message, 2, 3000).create();
                        }
                    }
                })
            });

            $('#submit-delete').on('click', function () {
                const id = this.dataset.id;

                const btn = $(this);
                btn.html(`<img src="{{ asset('images/icons/loading.gif') }}" alt="Carregando..." width="30">`);

                $.ajax({
                    method: 'DELETE',
                    url: "<?= route('users.destroy', '_user') ?>".replace('_user', id),
                    data: {
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('content'),
                    },
                    success(res) {
                        btn.off('click');
                        btn.html('Excluído!');

                        new popupAlert(res.message, 1, 3600000).create();

                        setTimeout(() => {
                            location.href = res.redirect;
                        }, 1500);
                    },
                    error(err) {
                        btn.html('Deletar');

                        if(err.status === 404) {
                            new popupAlert('Este usuário não existe! Tente recarregar a página.', 2, 3000).create();
                        } else {
                            console.log(err.responseJSON);
                            new popupAlert('Algo deu errado ao visualizar o usuário. Tente novamente mais tarde!', 2, 3000).create();
                        }
                    }
                });
            })

            $('.custom-select-2').on('click', function() {
                $(this).find('.select-selected').addClass('select-item-black');
            });

            $('.date').mask('00/00/0000');
        });
    </script>

@endpush
