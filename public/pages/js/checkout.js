$(function () {
    let minicart = JSON.parse(localStorage.getItem('minicart')) || [];
    let container = $('#checkout-container');

    if (minicart.length === 0) {
        container.html('<p class="text-muted">Keranjang kosong.</p>');
        return;
    }

    axios.get(baseUrl + '/api/shoes', {
        params: { _limit: 1000, _page: 1 }
    }, apiHeaders).then(function (response) {
        let allProducts = response.data.products;
        let html = '';
        let totalHarga = 0;

        minicart.forEach(item => {
            let product = allProducts.find(p => p.id == item.id);
            if (!product) return;

            let subtotal = item.qty * product.price;
            totalHarga += subtotal;

            html += `
            <div class="col-md-12 mb-3">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                    <div>
                        <h6>${product.title}</h6>
                        <small>Qty: ${item.qty}</small>
                    </div>
                    <strong>IDR ${subtotal.toLocaleString()}</strong>
                </div>
            </div>`;
        });

        // Metode Pembayaran //
        html += `
        <div class="col-md-12 mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Total: IDR ${totalHarga.toLocaleString()}</h5>
                <div class="form-group mb-0">
                    <label for="payment-method" class="me-2">Payment method :</label>
                    <select id="payment-method" class="form-select d-inline-block w-auto" style="min-width: 150px;">
                        <option value="Cash">Cash</option>
                        <option value="Qris">QRIS</option>
                        <option value="BCA">BCA</option>
                        <option value="BRI">BRI</option>
                        <option value="BNI">BNI</option>
                        <option value="Mandiri">Mandiri</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-dark mt-3 w-100" id="btn-pay">Pay now</button>
        </div>`;

        container.html(html);

        $('#btn-pay').on('click', function () {
            const metode = $('#payment-method').val();
            Swal.fire('Pembayaran', `Checkout successfully with ${metode}`, 'success');
            localStorage.removeItem('minicart');
            setTimeout(() => location.href = baseUrl + '/', 2000);
        });

    }).catch(function (error) {
        container.html('<p class="text-danger">Failed to load checkout</p>');
    });
});
