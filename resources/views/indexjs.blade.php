<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <title>Paginação</title>

        <style>
            body{
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card text-center">
                <div class="card-header">
                    Tabela de Clientes
                </div>

                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <table class="table table-hover" id="tabelaClientes">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Sobrenome</th>
                                <th scope="col">E-mail</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <nav id="paginator">
                        <ul class="pagination">
                        <!--
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>

                            <li class="page-item"><a class="page-link" href="#">1</a></li>

                            <li class="page-item active">
                                <a class="page-link" href="#">2</a>
                            </li>

                            <li class="page-item"><a class="page-link" href="#">3</a></li>

                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>        

        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>

        <script type="text/javascript">

            function montarLinha(cliente) {
                return  "<tr>" + 
                            "<td>" + cliente.id         + "</td>" +
                            "<td>" + cliente.nome       + "</td>" +
                            "<td>" + cliente.sobreNome  + "</td>" +
                            "<td>" + cliente.email      + "</td>" +
                        "<tr>";
            }

            function montarTabela(data){
                $("#tabelaClientes>tbody>tr").remove();

                for (i = 0; i < data.data.length; i++) {
                    s = montarLinha(data.data[i]);

                    $("#tabelaClientes tbody").append(s);
                }
            }

            function getItem(data, i) {
                active = "";
                if (i == data.current_page) {
                    active = "active";
                }

                s = '<li class="page-item ' + active + '"><a class="page-link" href="#">' + i + '</a></li>';

                return s;
                
            }

            function montarPaginator(data) {
                for (i = 1; i < data.total; i++) {
                    s = getItem(data, i);

                    $("#paginator>ul").append(s);
                }
            }

            function carregarClientes(pagina) {
                $.get('/json', {page: pagina}, function (resp) {
                    montarTabela(resp);
                    montarPaginator(resp);
                });
            }
            

            $(function(){
                carregarClientes(1);
            });
        </script>
    </body>
</html>
