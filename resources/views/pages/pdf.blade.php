<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Lista De Compras</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
        
     <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">

    @vite('resources/css/app.css')

    <style>
        * {
            font-family: "Nunito", sans-serif;
            /* Nunito */
        }

        h4 {
            margin: 0;
        }

        .cabecalho {
            border-width: 2px;
            border-style: solid;
            border-color: #d1d5db;
            border-radius: 0.50rem;
            padding: 2px;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .font {
            font-size: 12px;
        }

        .titles {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 12px;
        }

        .space {
            padding: 3px 5px;
        }

        .margin-top {
            margin-top: 7px;
        }

        .footer {
            font-size: 0.875rem;
            padding: 1rem;
            background-color: #e3e7ec;
            border-width: 2px;
            border-style: solid;
            border-color: #e3e7ec;
            border-radius: 0.50rem;
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.products {
            font-size: 0.875rem;
            border-width: 2px;
            border-style: solid;
            border-color: #d1d5db;
            border-radius: 0.50rem;
        }

        table.vencimentos {
            font-size: 0.875rem;
            border-width: 2px;
            border-style: solid;
            border-color: #e3e7ec;
            border-radius: 0.50rem;
        }

        table.notas {
            font-size: 0.875rem;
            border-width: 2px;
            border-style: solid;
            border-color: white;
            border-radius: 0.50rem;
        }

        table.table-footer {
            font-size: 0.875rem;
            border-top: 2px;
            border-style: solid;
            border-color: #d1d5db;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 12px;
        }

        table.products .table-cabecalho {
            background-color: #d1d5db;
            border-radius: 0.50rem;
        }

        table.products .table-cabecalho th {
            color: black;
            padding: 0.2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 11px;
        }

        table.vencimentos .table-cabecalho-vencimentos th {
            color: black;
            padding: 0.2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 11px;
        }

        /* table tr.items {
            background-color: rgb(241 245 249);
        } */

        table tr.items td {
            padding: 0.2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <table class="w-full">
        <tr class="">
            <td style="width: 100%;">
                <div>
                    <h4 style="text-transform: uppercase; letter-spacing: 3px; font-size: 25px; text-align: center;">
                        Lista de compras
                    </h4>
                </div>
                {{-- <div>{{ filial(null, ['NOME_FANTASIA'])->NOME_FANTASIA ?? '' }}</div> --}}
            </td>
        </tr>
    </table>

    <h1 style="margin: 6px 7em; padding:1px; background-color:#d1d3d8;"> </h1>

    <div class="margin-top">
        <table class="products">
            <thead>
                <tr class="table-cabecalho">
                    <th>
                        Cod
                    </th>

                    <th class="px-2 py-3">
                        Nome
                    </th>

                    <th>
                        Descrição
                    </th>

                    <th>
                        Marca
                    </th>
                    <th>
                        Qtd
                    </th>

                    <th>
                        VL. Unit.
                    </th>
                    <th>
                        Total
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($itens as $item)
                    <tr class="items">
                        <td style="font-size: 12px; text-align: center;">
                            {{ $item->id }}
                        </td>
                        <td style="font-size: 12px; text-align: center;">
                            {{ $item->nome }}
                        </td>
                        <td style="font-size: 11px; text-align: center;">
                            {{ $item->descricao }}
                        </td>
                        <td style="font-size: 10px; text-align: center;">
                            {{ $item->marca }}
                        </td>
                        <td style="font-size: 12px; text-align: center;">
                            {{ $item->quantidade ?? 0 }}
                        </td>
                        <td style="font-size: 12px; text-align: center;">
                            {{ number_format($item->valor, 2, ',') }}
                        </td>
                        <td style="font-size: 12px; text-align: center;">
                            {{ $item->quantidade_pedida ?? 0 }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="margin-top " style="margin: 0 10px;">
        <table class="w-full">
            <tr class="">
                <td style="width: 30%;">
                </td>
                <td style="width: 30%;">
                  
                </td>
                <td style="width: 40%;">
                    <h4 class="titles space">Total Geral:
                        <span class="font">{{ number_format($total, 2, ',', ' ') }}</span>
                    </h4>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer margin-top">
        <table class="w-full">
            <tr class="">
                <td style="width: 50%;">
                    <h4 class="titles space">Observação:</h4>
                    <div class="space" style="text-transform: uppercase; letter-spacing: 2px;">
                        {{ $lista->observacao }}
                    </div>
                </td>
                <td style="width: 50%;">
                    <h4 class="titles space">Descrição:</h4>
                    <div class="space" style="text-transform: uppercase; letter-spacing: 2px;">
                        {{ $lista->descricao }}
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
