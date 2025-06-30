@extends('layouts.app-public')
@section('title', 'Wishlist')

@section('content')
<div class="site-wrapper-reveal">
    <div class="single-product-wrap section-space--pt_90 border-bottom pb-5 mb-5">
        <div class="container">
            <h2 class="mb-4">Your wishlist :</h2>
            <div class="row" id="wishlist-container">
                <p class="text-muted">Loading...</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addition_script')
<script>
$(function () {
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
    let container = $('#wishlist-container');

    if (wishlist.length === 0) {
        container.html('<p class="text-muted">No products in your wishlists</p>');
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
        let filtered = allProducts.filter(p => wishlist.includes(p.id.toString()));

        if (filtered.length === 0) {
            container.html('<p class="text-muted">Your wishlist is empty.</p>');
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
                        <p class="card-text mb-2 text-muted">IDR ${parseFloat(product.price).toLocaleString()}</p>
                        <div class="mt-auto d-flex gap-2">
                            <a href="/shoes/${product.id}" class="btn btn-sm btn-dark w-100">See the detail</a>
                            <button class="btn btn-sm btn-outline-danger w-100 btn-remove-wishlist">Delete</button>
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
        container.html('<p class="text-danger">Failed to load wishlist</p>');
    });

    // Menghapus item dari wishlist //
    $(document).on('click', '.btn-remove-wishlist', function () {
        let productId = $(this).closest('[data-id]').data('id').toString();
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        wishlist = wishlist.filter(id => id !== productId);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        $(this).closest('[data-id]').remove();

        if ($('[data-id]').length === 0) {
            $('#wishlist-container').html('<p class="text-muted">Semua produk di wishlist telah dihapus.</p>');
        }
    });
});
</script>
@endsection
