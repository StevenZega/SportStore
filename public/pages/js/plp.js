let id_el_list = "#product-list";

function getDataOnEnter(event){
    if (event.keyCode == 13) {
        getData(1);
    }
}

function getData(toPage=1){
    let url = baseUrl+'/api/shoes';
    if(toPage){
        $("[name='_page']").val(toPage);
    }
    let payload = {
        '_limit': 8,
        '_page': toPage,
        '_search': $("[name='_search']").val(),
        '_sort_by': $("[name='_sort_by']").val(),
        '_type': $("[name='_type']").val()
    };

    $("._filter").each(function() {
        payload[$(this).attr('name')] = $(this).val();
    });

    axios.get(url,{params:payload},apiHeaders)
    .then(function (response) {
        console.log('[DATA] response..',response.data);
        let template = ``;
        // START-- products
        (response.data.products).forEach((item) => {
            template += `   <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="single-product-item text-center">
                                    <div class="products-images">
                                        <a href="/shoes/`+item.id+`" class="product-thumbnail">
                                            <img src="`+item.cover+`" alt="Product Images" class="product-img">
                                        </a>
                                        <div class="product-actions">
                                            <a href="/shoes/`+item.id+`"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                            <a href="#"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h6 class="product-title">
                                            <a href="/shoes/`+item.id+`">`+item.title+`</a>
                                        </h6>
                                        <small class="text-color-primary">`+item.brand+`</small>
                                        <div class="product-price">
                                            <span class="new-price">IDR `+parseFloat(item.price).toLocaleString()+`</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
        });
        $(id_el_list).html(template);
        // END---- products

        // START-- pagination
        $('#products_count_start').html(response.data.products_count_start);
        $('#products_count_end').html(response.data.products_count_end);
        $('#products_count_total').html(response.data.products_count_total);
        template = '';
        let max_page = Math.ceil(response.data.products_count_total/response.data.filter._limit);
        if(response.data.filter._page != 1){
            template += 
            `<li>
                <a class="prev page-numbers" onclick="getData(1)">
                    <i class="icon-chevron-left"></i>&nbsp;&nbsp;&nbsp;Min Page
                </a>
            </li>`;
        }
        if(response.data.filter._page > 1){
            template += 
            `<li>
                <a class="page-numbers" onclick="getData(`+(response.data.filter._page-1)+`)">
                    `+(response.data.filter._page-1)+`
                </a>
            </li>`;
        }
        template += `
            <li>
                <a class="current text-white page-numbers" onclick="getData(`+response.data.filter._page+`)">
                    `+response.data.filter._page+`
                </a>
            </li>`;
        if(response.data.filter._page < max_page){
            template += 
            `<li>
                <a class="page-numbers" onclick="getData(`+(response.data.filter._page+1)+`)">
                    `+(response.data.filter._page+1)+`
                </a>
            </li>`;
        }
        if(response.data.filter._page+1 < max_page){
            template += 
            `<li>
                <a class="page-numbers" onclick="getData(`+(response.data.filter._page+2)+`)">
                    `+(response.data.filter._page+2)+`
                </a>
            </li>`;
        }
        if(response.data.filter._page < max_page){
            template += 
            `<li>
                <a class="next page-numbers" onclick="getData(`+max_page+`)">
                    Max Page<i class="icon-chevron-right"></i>
                </a>
            </li>`;
        }
        $(id_el_list+'-pagination').html(template);
        $('[name="_page"]').val(response.data.filter._page);
        // END---- pagination

    })
    .catch(function (error) {
        console.log('[ERROR] response..',error);
        if(error.code == "ERR_BAD_REQUEST"){
            Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "Ooopss",
                html: "No product matches!",
                showConfirmButton: false,
                timer: 3000
            });
        }else{
            Swal.fire({
                icon: 'error',
                width: 600,
                title: "Error",
                html: error.message,
                confirmButtonText: 'Yes',
            });
        }
    });
}

$(function () {
    getData();
});
