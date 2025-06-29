function getDataByWindowUrlKey() {
    let windowUrl = $(location).attr('href');
    let windowUrlKey = windowUrl.replace(/\/\s*$/, "").split('/').pop();
    let url = baseUrl + '/api/shoes/' + windowUrlKey;

    axios.get(url, {}, apiHeaders)
        .then(function (response) {
            let product = response.data.data;
            console.log('[DATA] response..', product);
            let template = '';

            // Gambar utama
            $('.product-img-main-href').attr('href', product.cover);
            $('.product-img-main-src').attr('src', product.cover);

            // THUMBNAILS
            let thumbnails = [product.cover];
            if (product.image_1) thumbnails.push(product.image_1);
            if (product.image_2) thumbnails.push(product.image_2);

            template = '';
            thumbnails.forEach((src) => {
                template += `<div class="sm-image">
                                <img src="${src}" alt="thumbnail" class="product-thumbnail-img" style="cursor:pointer">
                            </div>`;
            });
            $('#product-thumbnails').html(template);

            $('.product-thumbnail-img').on('click', function () {
                let src = $(this).attr('src');
                $('.product-img-main-href').attr('href', src);
                $('.product-img-main-src').attr('src', src);
            });

            $('#product-name').html(product.name);
            $('#product-price').html('IDR ' + parseFloat(product.price).toLocaleString());
            $('#product-description').html(product.description ?? '-');
            $('#product-author').html(product.brand);
            $('#product-publisher').html('');

            let stars = randomIntFromInterval(1, 5);
            template = '';
            for (let index = 0; index < 5; index++) {
                template += '<i class="' + (index < stars ? 'yellow' : '') + ' icon_star"></i>';
            }
            $('#product-review-stars').html(template);
            $('#product-review-body-count').html(randomIntFromInterval(1, 1000) + ' customer review');

            let statusStock = randomIntFromInterval(0, 1);
            $('#product-status-stock')
                .addClass(statusStock ? 'in-stock' : 'out-of-stock')
                .html(
                    statusStock
                        ? '<p>Available: <span>In stock</span></p>'
                        : '<p>Available: <span>Out of stock</span></p>'
                );

            if (!statusStock) {
                $('.product-add-to-cart').hide();
                $('.product-add-to-cart-is-disabled').show();
            }

            let collectionOfTag = ['Shoes', 'Bag', 'Jacket', 'Pants', 'T-Shirt', 'Sportwear', 'Running', 'Best Seller', 'Limited Edition'];
            let selectedTags = collectionOfTag.sort(() => 0.5 - Math.random()).slice(0, 4);
            template = '';
            selectedTags.forEach((tag, index) => {
                template += `<a href="#">${tag}</a>${index !== selectedTags.length - 1 ? ', ' : ''}`;
            });
            $('#product-tags').html(template);

            // ====== WISHLIST ACTION ======
            $('.quickview-wishlist a').off('click').on('click', function (e) {
                e.preventDefault();
                let productId = product.id.toString();
                let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

                if (!wishlist.includes(productId)) {
                    wishlist.push(productId);
                    localStorage.setItem('wishlist', JSON.stringify(wishlist));
                    Swal.fire('Ditambahkan!', 'Produk masuk ke wishlist kamu.', 'success');
                } else {
                    Swal.fire('Sudah ada', 'Produk ini sudah ada di wishlist.', 'info');
                }
            });

            // ====== MINICART ACTION ======
            $('.btn-add-minicart').off('click').on('click', function (e) {
                e.preventDefault();
                let qty = parseInt($('.cart-plus-minus-box').val());
                if (isNaN(qty) || qty <= 0) {
                    Swal.fire('Oops!', 'Jumlah harus lebih dari 0.', 'warning');
                    return;
                }

                let minicart = JSON.parse(localStorage.getItem('minicart')) || [];

                let existingIndex = minicart.findIndex(item => item.id == product.id);
                if (existingIndex >= 0) {
                    minicart[existingIndex].qty += qty;
                } else {
                    minicart.push({ id: product.id, qty: qty });
                }

                localStorage.setItem('minicart', JSON.stringify(minicart));
                Swal.fire('Berhasil!', 'Produk masuk ke keranjang.', 'success');
            });

        })
        .catch(function (error) {
            console.log('[ERROR] response..', error.code);
            if (error.code === "ERR_BAD_REQUEST") {
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Yaah...",
                    html: "Produk yang Anda cari tidak ditemukan",
                    showConfirmButton: false,
                    timer: 5000
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    width: 600,
                    title: "Error",
                    html: error.message,
                    confirmButtonText: 'Ya',
                });
            }
        });
}

$(function () {
    getDataByWindowUrlKey();
});
