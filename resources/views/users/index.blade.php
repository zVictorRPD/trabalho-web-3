@extends('layouts.main')

@section('title', 'Passageiros')

@push('css')

@endpush

@section('container')
    <div class="main-container">
        <h1 class="page-title">Passageiros</h1>
        <div class="d-flex justify-content-end">
            <a href="{{ route('passengers.create') }}"><button class="btn-default btn-green mr-4">Cadastrar</button></a>
            <button class="btn-default btn-blue ml-2 mr-1" data-toggle="modal" data-target="#filterModal">Filtrar</button>
        </div>

        <div class="main-card blue-card">
            <div class="table-responsive">
                <table id="table-id" class="table table-stripped dt-bootstrap5">
                    <thead>
                        <th class="first-column">Cód.</th>
                        <th>Nome</th>
                        <th>Sexo</th>
                        <th>Nascimento</th>
                        <th>Cód. País</th>
                        <th>E. Cívil</th>
                        <th>Responsável</th>
                        <th class="last-column">Ações</th>
                    </thead>
                    <tbody>
                        {{-- @foreach ($passengers as $passenger)
                            <tr id="linha-{{ $passenger->CD_PSGR }}">
                                <td class="first-column">{{ $passenger->CD_PSGR }}</td>
                                <td>{{ $passenger->NM_PSGR }}</td>
                                <td>{{ $passenger->IC_SEXO_PSGR }}</td>
                                <td>{{ $passenger->DT_NASC_PSGR }}</td>
                                <td>{{ $passenger->CD_PAIS }}</td>
                                <td>{{ $passenger->IC_ESTD_CIVIL }}</td>
                                <td>{{ $passenger->CD_PSGR_RESP }}</td>
                                <td class="last-column">
                                    <div class="d-flex justify-content-center">
                                        <button id="edit-{{ $passenger->CD_PSGR }}" class="icon icon-edit"
                                            data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" form="delete_{{ $passenger->CD_PSGR }}"
                                            class="icon icon-delete" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form method="POST"
                                            action="{{ route('passengers.destroy', $passenger->CD_PSGR) }}"
                                            id="delete_{{ $passenger->CD_PSGR }}" class="form-delete-client">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach --}}
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
                        Deletar linha de Passageiros
                    </h5>
                </div>

                <div class="modal-body">
                    <p class="modal-text">
                        Deseja realmente deletar o Passageiro
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
                        Editar tabela de Passageiros
                    </h5>
                </div>

                <div class="modal-body">
                    <form id="edit-form" action="" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Nome</label>
                                <input class="register-input" name="NM_PSGR" type="text" placeholder="Insira o nome">
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Sexo</label>
                                <div class="custom-select-2">
                                    <select class="register-input" name="IC_SEXO_PSGR">
                                        <option value="">Selecione seu sexo</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                        <option value="O">Outros</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Nascimento</label>
                                <input class="register-input date" name="DT_NASC_PSGR" type="text" placeholder="Insira a data de nascimento">
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">País de Origem</label>
                                <div class="custom-select-2">
                                    <select class="register-input" name="CD_PAIS">
                                        <option value="">Selecione o país de origem</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Estado Cívil</label>
                                <div class="custom-select-2">
                                    <select class="register-input" name="IC_ESTD_CIVIL">
                                        <option value="">Selecione o estado cívil</option>
                                        <option value="">Solteiro(a)</option>
                                        <option value="">Casado(a)</option>
                                        <option value="">Separado(a)</option>
                                        <option value="">Divorciado(a)</option>
                                        <option value="">Viúvo(a)</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 px-5 my-2 my-md-4">
                                <label class="register-label" for="">Tem Responsável</label>
                                <div class="d-flex">
                                    <div class="d-flex justify-content-center">
                                        <label class="radio-container mr-1">
                                            <input class="radio-input" type="radio" name="has_responsible" value="0">
                                            <span class="radio-span"></span>
                                        </label>
                                        <div class="register-label ml-4">Não</div>
                                    </div>
                                    <div class="d-flex justify-content-center ml-5">
                                        <label class="radio-container mr-1">
                                            <input class="radio-input" type="radio" name="has_responsible" value="1">
                                            <span class="radio-span"></span>
                                        </label>
                                        <div class="register-label ml-4">Sim</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="btn-div d-flex justify-content-end">
                            <button type="button" class="delete-dismiss btn-default btn-red"
                                data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="edit-submit btn-default btn-blue ml-4">Editar</button>
                        </div>
                        @method('PUT');
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Filtro --}}
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-default">
                <div class="modal-header-default text-white">
                    <h5 class="modal-title" id="filterModalLabel">
                        Filtrar tabela de Voos
                    </h5>
                </div>

                <div class="modal-body">
                    <div class="alert alert-color alert-dismissable" role="alert">
                        <i style="font-size: 125%" class="fa fa-exclamation-circle mr-2"></i>Este filtro deve responder às
                        perguntas: 71 e 87

                        <span data-dismiss="alert" class="close p-0" aria-label="Close"></span>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 px-5 my-2 my-md-4">
                            <label class="register-label" for="from">Estado Civil</label>
                            <div class="custom-select-2">
                                <select class="register-input" name="civil">
                                    <option value="null">Selecione o estado civil</option>
                                    <option value="S">Solteiro(a)</option>
                                    <option value="C">Casado(a)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 px-5 my-2 my-md-4">
                            <label class="register-label" for="to">Sexo</label>
                            <div class="custom-select-2">
                                <select class="register-input" name="sex">
                                    <option value="null">Selecione o sexo</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                    <option value="O">Outros</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="filter-table-container" class="table-responsive" style="display: none">
                        <table id="filter-table" class="table table-stripped dt-bootstrap5">
                            <thead>
                                <th class="first-column">Nome</th>
                                <th>Idade</th>
                                <th>Data Nasc.</th>
                                <th class="last-column">Idade acima da média?</th>
                            </thead>
                            <tbody id="filter-table-body" style="display: none">

                            </tbody>
                        </table>
                    </div>

                    <div class="btn-div d-flex justify-content-end">
                        <button type="button" class="filter-dismiss btn-default btn-red"
                            data-dismiss="modal">Cancelar</button>
                        <button type="button" class="filter-submit btn-default btn-blue ml-4">Filtrar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let filter_table = null;

        $(function() {
            $('#table-id').DataTable({
                language: {
                    url: "<?= asset('js/datatable.json') ?>"
                }
            });

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
                $('#edit-form').attr('action', "<?= route('passengers.update', ['_id_']) ?>".replace('_id_', id));
                // -1 no for pq ignoramos o @crf e o campo com o id
                for (i = 0; i < td_array.length - 1; i++) {
                    if (input_array.eq(i).attr('type') == "hidden") continue;
                    if(input_array.eq(i).attr('type') == undefined){
                        input_array.eq(i).val(td_array.eq(i).html());
                        input_array.eq(i).next().html(td_array.eq(i).html()).addClass('select-item-black');
                    }else{
                        input_array.eq(i).val(td_array.eq(i).html());
                    }
                }
            });

            $('.radio-input').on('change', function() {
                if ($(this).val() == "1") {
                    $('#responsible-div').collapse('show')
                } else if ($(this).val() == "0") {
                    $('#responsible-div').collapse('hide')
                }
            });

            $('.filter-submit').on('click', function() {
                const civil = $('select[name=civil]').val();
                const sex = $('select[name=sex]').val();

                $.ajax({
                    method: 'GET',
                    url: "<?= route('passengers.filter', ['_civil_', '_sex_']) ?>".replace(
                        '_civil_', civil).replace('_sex_', sex),
                    success: res => {
                        $('#filter-table-container').fadeIn();
                        $('#filter-table-body').fadeOut('swing', function() {
                            if (filter_table) {
                                filter_table.destroy();

                                $('#filter-table-body').html('');
                            }

                            for (let passenger of res.passengers) {
                                $('#filter-table-body').append(`
                                    <tr>
                                        <td class="first-column">${passenger.NM_PSGR}</td>
                                        <td>${passenger.ID_PSGR || 'Não Informado'}</td>
                                        <td>${passenger.DT_NASC_PSGR != null ? passenger.DT_NASC_PSGR.split('/').reverse().join('/') : 'Não Informado'}</td>
                                        <td class="last-column">${passenger.ID_PSGR != null ? (passenger.ID_PSGR > res.avg_age ? 'Sim' : 'Não') : '---'}</td>
                                    </tr>
                                `);
                            }

                            filter_table = $('#filter-table').DataTable({
                                language: {
                                    url: "<?= asset('js/datatable.json') ?>"
                                }
                            });

                            $('#filter-table-body').fadeIn()
                        });
                    },
                    error: err => {
                        console.log(err);
                    }
                });
            });

            $('.custom-select-2').on('click', function() {
                $(this).find('.select-selected').addClass('select-item-black');
            });
            $('.date').mask('00/00/0000');
        });
    </script>

@endpush
