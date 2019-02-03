
@extends('layout')

@section('title', 'PayMe Sales Manager - Create New Sale')

@section('content')
    <div id="pay-frame" class="iframe-wrapper">
        <iframe id="pay-iframe"></iframe>
    </div>
    <div id="new-sale" class="form-wrapper">
        <h1> New Sale Creation</h1>
        <form id="sale-form" method="POST" action="/api/sales">
            <div class="form-group">
                <label for="name">Product name</label>
                <input type="text" class="form-control" id="name" name="product_name" required />
            </div>
            <div class="form-group">
                <label for="name">Price</label>
                <input type="number" class="form-control" id="price" name="sale_price" required />
            </div>
            <div class="form-group">
                <label for="currency">Currency</label>
                <select id="currency" name="currency">
                    <option value="ILS">ILS</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>                                        
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Insert Payment Details</btn>
            </div>
            
        </form>

        <div class="form-error">
        <p id="form-error"></p>
        </div>

        <div class="form-loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById('sale-form');
            form.onsubmit = function(evt) {
                evt.preventDefault();
                document.getElementById('form-error').textContent = "";
                document.querySelector('.form-loading').style.display = "block";
                fetch(this.action, {
                    method: 'POST',
                    body:new FormData(this)
                }).then((res) => {
                    document.querySelector('.form-loading').style.display = "none";
                    return res.json();
                })
                .then((response) =>  {
                    if (response.success) {
                        document.getElementById('pay-iframe').src = response.sale.payment_link;
                        document.getElementById('new-sale').style.display = "none";
                        document.getElementById('pay-frame').style.display = "block";
                    }
                    else {
                        document.getElementById('form-error').textContent = response.message;
                    }
                })
                .catch((err)=>console.log(err));
            }
        });
    </script>

    <a href="/sales" class="back-link"> < BACK </a>
@endsection