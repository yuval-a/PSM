
@extends('layout')

@section('title', 'PayMe Sales Manager - Sale History')

@section('content')

    <div id="sales-table">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr class="table-primary">
                    <th scope="col"> Time </th>
                    <th scope="col"> Sale Number </th>
                    <th scope="col"> Description </th>
                    <th scope="col"> Amount </th>
                    <th scope="col"> Currency </th>
                    <th scope="col"> Payment Link </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td> {{ $sale->sale_time }} </td>
                    <td> {{ $sale->sale_number }} </td>
                    <td> {{ $sale->description }} </td>
                    <td> {{ $sale->amount }} </td>
                    <td> {{ $sale->currency }} </td>
                    <td> <a class="payment-link" href="{{ $sale->payment_link }}">Payment Page Link</a> </td>
                </tr>
            @endforeach
            
            </tbody>
        </table>

        {{ $sales->links() }}

    </div>

    <a href="/sales" class="back-link"> < BACK </a>
@endsection