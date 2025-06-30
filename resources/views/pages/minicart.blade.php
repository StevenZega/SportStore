@extends('layouts.app-public')
@section('title', 'minicart')

@section('content')
<div class="site-wrapper-reveal">
    <div class="single-product-wrap section-space--pt_90 border-bottom pb-5 mb-5">
        <div class="container">
            <h2 class="mb-4">Your minicart :</h2>
            <div class="row" id="minicart-container">
                <p class="text-muted">Loading...</p>
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
        container.html('<p class="text-muted">No products in your minicarts</p>');
        return;
    }

    axios.get(baseUrl + '/api/shoes', {
        params: {
            _limit: 1000,
            _page: 1
        }
    }, apiHeaders)
    .then(function (response) {
        let allProducts = response.data.products;
        let filtered = allProducts
            .filter(p => minicart.find(m => m.id == p.id))
            .map(p => {
                let found = minicart.find(m => m.id == p.id);
                return {
                    ...p,
                    qty: found.qty
                };
            });

        if (filtered.length === 0) {
            container.html('<p class="text-muted">Your minicart is empty.</p>');
            return;
        }

        let html = '';
        filtered.forEach(product => {
            html += `
            <div class="col-md-3 col-sm-6 mb-4" data-id="${product.id}">
                <div class="card h-100 border shadow-sm">
                    <img src="${product.cover}" class="card-img-top" alt="${product.title}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title mb-1">${product.title}</h6>
                        <p class="card-text">Quantity : ${product.qty}</p>
                        <p class="card-text">Total: IDR ${(product.price * product.qty).toLocaleString()}</p>
                        <div class="mt-auto d-flex gap-2">
                            <a href="/checkout" class="btn btn-sm btn-success w-100">Checkout</a>
                            <button class="btn btn-sm btn-outline-danger w-100 btn-remove-minicart mt-2">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            `;
        });
        container.html(html);
    })
    .catch(function (error) {
        console.error(error);
        container.html('<p class="text-danger">Failed to load minicart</p>');
    });

    // Menghapus item dari minicart //
    $(document).on('click', '.btn-remove-minicart', function () {
        let productId = $(this).closest('[data-id]').data('id').toString();
        let minicart = JSON.parse(localStorage.getItem('minicart')) || [];
        minicart = minicart.filter(id => id !== productId);
        localStorage.setItem('minicart', JSON.stringify(minicart));
        $(this).closest('[data-id]').remove();

        if ($('[data-id]').length === 0) {
            $('#minicart-container').html('<p class="text-muted">No products in your minicart</p>');
        }
    });
});
</script>
@endsection
