$(document).ready(function () {
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    if (wishlist.length === 0) {
        $('#wishlist-items').html('<p>Wishlist kamu kosong 😢</p>');
        return;
    }

    let html = '';
    wishlist.forEach((id) => {
        axios.get(baseUrl + '/api/shoes/' + id, {}, apiHeaders)
        .then(res => {
            const product = res.data.data;

            html += `
                <div class="wishlist-item d-flex align-items-center border rounded p-3 mb-3" data-id="${product.id}">
                    <img src="${product.cover}" class="me-3" style="max-width:100px; border-radius:6px;">
                    <div class="flex-grow-1">
                        <h5 class="mb-1">${product.name}</h5>
                        <p class="mb-1"><strong>Brand:</strong> ${product.brand}</p>
                        <p class="mb-2"><strong>Price:</strong> IDR ${parseFloat(product.price).toLocaleString()}</p>
                        <div class="d-flex gap-2">
                            <a href="/shoes/${product.id}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                            <button class="btn btn-sm btn-outline-danger btn-remove" data-id="${product.id}">Hapus</button>
                        </div>
                    </div>
                </div>
            `;

            $('#wishlist-items').html(html);
        })
        .catch(err => {
            console.warn('Produk tidak ditemukan:', id);
        });
    });

    // Hapus produk dari wishlist
    $(document).on('click', '.btn-remove', function () {
        let productId = $(this).data('id').toString();
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        wishlist = wishlist.filter(id => id !== productId);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        location.reload();
    });
});
