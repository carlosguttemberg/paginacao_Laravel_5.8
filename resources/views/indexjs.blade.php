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
                </div>
            </div>
        </div>        

        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>

        <script type="text/javascript">

            function montarLinha(cliente) {
                return  "<tr>" + 
                            "<td>" + cliente.id         + "</td>" +
                            "<td>" + cliente.nome       + "</td>" +
                            "<td>" + cliente.sobrenome  + "</td>" +
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

            function carregarClientes(pagina) {
                $.get('/json', {page: pagina}, function (resp) {
                    montarTabela(resp);
                });
            }
            

            $(function(){
                carregarClientes(1);
            });
        </script>
    </body>
</html>
