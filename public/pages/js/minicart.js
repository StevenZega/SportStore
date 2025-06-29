$(function () {
    let minicart = JSON.parse(localStorage.getItem('minicart')) || [];
    let container = $('#minicart-container');

    if (minicart.length === 0) {
        container.html('<p class="text-muted">Keranjang kamu kosong.</p>');
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
                <div class="card h-100 border">
                    <img src="${product.cover}" class="card-img-top" alt="${product.name}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">${product.name}</h5>
                        <p class="card-text">Qty: ${qty}</p>
                        <p class="card-text">Total: IDR ${(product.price * qty).toLocaleString()}</p>
                        <a href="/shoes/${product.id}" class="btn btn-sm btn-dark">Lihat Detail</a>
                        <button class="btn btn-sm btn-outline-danger btn-remove-from-cart mt-2">Hapus</button>
                    </div>
                </div>
            </div>
            `;
        })
        .catch(err => {
            console.warn('Produk tidak ditemukan:', item.id);
        })
        .finally(() => {
            loaded++;
            if (loaded === minicart.length) {
                if (html === '') {
                    container.html('<p class="text-muted">Semua produk di keranjang tidak ditemukan.</p>');
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
                        container.html('<p class="text-muted">Semua produk di keranjang telah dihapus.</p>');
                    }
                });
            }
        });
    });
});
