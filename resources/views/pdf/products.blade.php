<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-size: 10px;
        }

        #products {
            border-collapse: collapse;
            width: 100%;
        }

        #products td,
        #products th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #products tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #products tr:hover {
            background-color: #ddd;
        }

        #products th {
            padding: 12px 6px;
            text-align: left;
            background-color: #212738;
            color: white;
            text-align: center;
        }

        #products .group {
            text-align: left;
            background-color: #f97068;
        }

        #products tr.sum {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }

        #products tr.sum>td {
            border: none;
        }

        #products tr.total {
            background-color: #57c4e5;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            color: #EDF2EF
        }

        #products tr.total>td {
            border: none;
        }
    </style>
</head>

<body>
    @php
        $count = 0;
    @endphp
    <h1>Остаток</h1>

    @if ($balance)
        <table id="products">
            <tr>
                <th colspan="3">Название</th>
                <th colspan="2">Остаток на складе</th>
            </tr>

            @foreach ($balance as $category => $left)
                @if (count($left))
                    <tr>
                        <th colspan="6" class="group">{{ $category }}</th>
                    </tr>
                    @foreach ($left as $products)
                        <tr>
                            <td colspan="3">{{ $products->name }}</td>
                            <td colspan="2">{{ $products->products_left }}</td>
                        </tr>
                    @endforeach
                    <tr class="sum">
                        <td colspan="2">
                            </th>
                        <td colspan="2">Итого по группе: </th>
                        <td colspan="2">{{ $left->sum('products_left') }}</th>
                    </tr>
                    @php
                        $count += $left->sum('products_left');
                    @endphp
                @endif
            @endforeach

            <tr class="total">
                <td colspan="2">
                    </th>
                <td colspan="2">Итого: </th>
                <td colspan="2">{{ $count }}</th>
            </tr>

        </table>
    @else
        <div style="font-size: 16px"> Ничего не осталось</div>
    @endif

</body>

</html>
