@extends('layouts.main')

@section('title', 'Usuários | Novo')

@push('css')

@endpush

@section('container')
    <div class="main-container">
        <h1 class="page-title">Cadastro de Usuários</h1>

        <div class="register-card blue-card">
            <div class="form-row">
                <div class="col-md-6 px-5 my-2 my-md-4">
                    <label class="register-label" for="">Nome</label>
                    <input class="register-input" name="name" type="text" placeholder="Insira o nome"
                        value="{{ old('name') }}">
                        <small id="name-error" class="text-danger" hidden></small>
                </div>
                <div class="col-md-6 px-5 my-2 my-md-4">
                    <label class="register-label" for="">Nascimento</label>
                    <input class="register-input date" name="birth" type="text"
                        placeholder="Insira a data de nascimento" value="{{ old('birth') }}">
                    <small id="birth-error" class="text-danger" hidden></small>
                </div>
                <div class="col-md-6 px-5 my-2 my-md-4">
                    <label class="register-label" for="">CPF</label>
                    <input class="register-input cpf" name="cpf" type="text" placeholder="Insira o cpf"
                        value="{{ old('cpf') }}">
                    <small id="cpf-error" class="text-danger" hidden></small>
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
                    <small id="sex-error" class="text-danger" hidden></small>
                </div>
                <div class="col-md-6 px-5 my-2 my-md-4">
                    <label class="register-label" for="">Email</label>
                    <input class="register-input" name="email" type="text" placeholder="Insira o email"
                        value="{{ old('email') }}">
                    <small id="email-error" class="text-danger" hidden></small>
                </div>
                <div class="col-md-6 px-5 my-2 my-md-4">
                    <label class="register-label" for="">Senha</label><i class="ml-2 fa fa-question-circle-o" data-toggle="tooltip" title="A senha deve conter apenas letras e/ou números"></i>
                    <input class="register-input" name="password" type="password" placeholder="Insira a senha">
                    <small id="password-error" class="text-danger" hidden></small>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button id="reset" class="btn-default btn-blue ml-2 mr-4">Limpar</button>
                <button id="submit" class="btn-default btn-green ml-2 mr-5">Cadastrar</button>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('.custom-select-2').on('click', function() {
                $(this).find('.select-selected').addClass('select-item-black');
            });
            $('.date').mask('00/00/0000');
            $('.cpf').mask('000.000.000-00');

            $('#submit').on('click', function () {
                $('small').prop('hidden', true);

                const btn = $(this);
                btn.html(`<img src="{{ asset('images/icons/loading.gif') }}" alt="Carregando..." width="30">`);

                $.ajax({
                    method: 'POST',
                    url: "<?= route('users.store') ?>",
                    data: {
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        name: $('input[name=name]').val(),
                        cpf: $('input[name=cpf]').val(),
                        birth: $('input[name=birth]').val(),
                        sex: $('select[name=sex]').val(),
                        email: $('input[name=email]').val(),
                        password: $('input[name=password]').val()
                    },
                    success(res) {
                        btn.off('click');
                        btn.html('Cadastrado!');

                        new popupAlert(res.message, 1, 3600000).create();

                        setTimeout(() => {
                            location.href = res.redirect;
                        }, 1500);
                    },
                    error(err) {
                        if(err.status === 422) {
                            const errors = err.responseJSON.errors;
                            console.log(errors);

                            for(let field in errors) {
                                const error_message = errors[field][0];

                                const error_field = $(`small#${field}-error`);
                                error_field.html(error_message);
                                error_field.prop('hidden', false);
                            }
                        } else {
                            new popupAlert(err.responseJSON.message, 2, 3000).create();
                        }

                        btn.html('Cadastrar');
                    }
                });
            });
        });
    </script>
@endpush
