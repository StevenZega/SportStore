@extends('layouts.app-public')
@section('title', 'MiniCart')

@section('content')
<div class="site-wrapper-reveal">
    <div class="single-product-wrap section-space--pt_90 border-bottom pb-5 mb-5">
        <div class="container">
            <h2 class="mb-4">Your minicart :</h2>
            <div class="row" id="minicart-container">
                <p class="text-muted">Loading minicard...</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addition_script')
<script>
$(function () {
    let minicart = JSON.parse(localStorage.getItem('minicart')) || [];
    let container = $('#minicart-container');

    if (minicart.length === 0) {
        container.html('<p class="text-muted">Your minicart is empty</p>');
        return;
    }

    let html = '';
    let loaded = 0;

    minicart.forEach(item => {
        axios.get(baseUrl + '/api/shoes/' + item.id, {}, apiHeaders)
        .then(res => {
            let product = res.data.data;
            let qty = item.qty;

            html += `
            <div class="col-md-3 col-sm-6 mb-4" data-id="${product.id}">
                <div class="card h-100 border shadow-sm">
                    <img src="${product.cover}" class="card-img-top" alt="${product.title}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title mb-1">${product.title}</h6>
                        <p class="card-text">Quantity : ${qty}</p>
                        <p class="card-text">Total: IDR ${(product.price * qty).toLocaleString()}</p>
                        <div class="mt-auto d-flex gap-2">
                            <a href="/shoes/${product.id}" class="btn btn-sm btn-dark w-100">See the detail</a>
                            <button class="btn btn-sm btn-outline-danger w-100 btn-remove-from-cart mt-2">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            `;
        })
        
        .catch(err => {
            console.warn('Products not found', item.id);
        })
        .finally(() => {
            loaded++;
            if (loaded === minicart.length) {
                if (html === '') {
                    container.html('<p class="text-muted">All products in minicart are not found</p>');
                } else {
                    container.html(html);
                }

                // Event: hapus dari minicart
                $('.btn-remove-from-cart').on('click', function () {
                    let id = $(this).closest('[data-id]').data('id');
                    let minicart = JSON.parse(localStorage.getItem('minicart')) || [];
                    minicart = minicart.filter(item => item.id !== id);
                    localStorage.setItem('minicart', JSON.stringify(minicart));
                    $(this).closest('[data-id]').remove();

                    if ($('[data-id]').length === 0) {
                        container.html('<p class="text-muted">All products in minicard has been deleted</p>');
                    }
                });
            }
        });
    });
});
</script>
@endsection
