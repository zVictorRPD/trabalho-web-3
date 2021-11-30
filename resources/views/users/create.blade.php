@extends('layouts.main')

@section('title', 'Usuários | Novo')

@push('css')

@endpush

@section('container')
    <div class="main-container">
        <h1 class="page-title">Cadastro de Usuários</h1>

        <div class="register-card blue-card">
            <form action="" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-md-6 px-5 my-2 my-md-4">
                        <label class="register-label" for="">Nome</label>
                        @error('name')
                            <small class="text-danger ml-3">{{ $message }}</small>
                        @enderror
                        <input class="register-input" name="name" type="text" placeholder="Insira o nome"
                            value="{{ old('name') }}">

                    </div>
                    <div class="col-md-6 px-5 my-2 my-md-4">
                        <label class="register-label" for="">Nascimento</label>
                        <input class="register-input date" name="birth" type="text"
                            placeholder="Insira a data de nascimento" value="{{ old('birth') }}">
                        @error('birth')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 px-5 my-2 my-md-4">
                        <label class="register-label" for="">CPF</label>
                        <input class="register-input cpf" name="cpf" type="text" placeholder="Insira o cpf"
                            value="{{ old('cpf') }}">
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
                        <input class="register-input" name="email" type="text" placeholder="Insira o email"
                            value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 px-5 my-2 my-md-4">
                        <label class="register-label" for="">Senha</label>
                        <input class="register-input" name="password" type="text" placeholder="Insira a senha"
                            value="{{ old('password') }}">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="reset" class="btn-default btn-blue ml-2 mr-4">Limpar</button>
                    <button type="submit" class="btn-default btn-green ml-2 mr-5">Cadastrar</button>
                </div>
            </form>
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
        });
    </script>

@endpush
