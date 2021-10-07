$(() => {
    if (window.location.href == route("user.dashboard.index")) {
        const order_data = [
            { data: "product.name" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".order_dt"), route("user.dashboard.index"), order_data);
    }
});

// global variables
let tax = 0;
let list_of_price = [];

// get * products by category
async function getProduct(category) {
    const res = await axios.get(route("user.order.create"), {
        params: { category: category.value },
    });
    const categories = res.data.results.categories;
    tax = res.data.results.tax; // assign tax

    if (categories.length > 0) {
        let output = `<option></option>`;
        categories.forEach((product) => {
            output += `<option data-price='${product.price}' data-name='${product.name}' value='${product.id}'>${product.name} - ₱ ${product.price}</option>`;
        });

        $("#d_product_list").html(output);
    } else {
        $("#d_product_list").html(`<option> No Available Product</option>`);
        $("#d_selected_products").html(``);
        $("#d_billing").html(``);
    }
}

async function selectProduct(product) {
    if (product.value) {
        const product_name = $(product).find(":selected").attr("data-name");
        const price = $(product).find(":selected").attr("data-price");

        // products
        $("#d_selected_products")
            .append(` <span class="badge bg-dark text-white p-2 product-${product.value} mb-2">${product_name}
                        <i class='fas fa-times-circle text-white fa-sm' role='button' onclick='removeSelectedProduct(${product.value})' ></i>
                      </span>`);

        // inputs
        $("#d_inputs").append(
            `<input class='product-${product.value}' type='hidden' name='product_id[]' value='${product.value}'>`
        );

        list_of_price.push(price);
        let total = list_of_price.reduce(getSum, 0);

        //billings

        let billing_output = `<div class='form-group mt-3'>
                                    <label>Sub total</label>
                                    <input class='form-control' type='text' value='₱ ${total}' readonly>
                             </div>
                             <div class='form-group'>
                                    <label>Vat</label>
                                    <input class='form-control' type='text' value='${getPercentage(
                                        tax.tax
                                    )} %' readonly>
                                    <input type='hidden' name='tax_id' value='${
                                        tax.id
                                    }'> 
                             </div>
                             <div class='input-group mb-2' id='d_coupon'>
                                <input class='form-control' type='text' id='coupon' placeholder='Add Coupon (Optional)' oninput="this.value = this.value.toUpperCase();">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick='checkCoupon()'>Check Availability</button>
                                </div>
                             </div>
                             <div id='d_coupon_discount'>
                             
                             </div>
                             <div class='form-group'>
                                    <label>Amount to Pay</label>
                                    <input class='form-control' type='text' name='amount_paid' id='amount_paid' value='${addTaxation(
                                        total
                                    )}' readonly>
                             </div>
                             `;

        $("#d_billing").html(billing_output);
    } else {
        $("#d_billing").html(``);
        $("#d_selected_products").html(``);
        list_of_price = [];
    }
}

async function checkCoupon() {
    const code = $("#coupon").val();
    if (code) {
        try {
            const res = await axios.post(route("user.coupon.show"), { code });
            const coupon = res.data.result;

            // append / display coupon discount

            let output = `<div class='form-group'>
                            <label>Coupon Discount</label>
                            <input class='form-control' type='text' value='${getPercentage(
                                coupon.discount
                            )} %' readonly>
                            <input type='hidden' name='coupon_id' value='${
                                coupon.id
                            }'>
                        </div>`;

            // recompute total amount paid

            const total_amount_paid = addCouponDiscount(coupon.discount);
            $("#amount_paid").val(total_amount_paid);

            $("#d_coupon_discount").html(output);
        } catch (e) {
            error(e.response.data.message);
            $("#d_coupon_discount").html(``);
        }
    } else {
        $("#d_coupon_discount").html(``);
    }
}

function addCouponDiscount(discount) {
    const current_total_amt_paid = $("#amount_paid").val();
    const discounted_amount = current_total_amt_paid * discount;
    return (current_total_amt_paid - discounted_amount).toFixed(2); // total discounted amount
}

function removeSelectedProduct(id) {
    $(".product-" + id).remove();
}

function addTaxation(amount) {
    const tax_amount = amount * tax.tax;

    return (parseFloat(amount) + parseFloat(tax_amount)).toFixed(2); // total taxation amount
}

async function showOrder(order) {
    try {
        list_of_price = [];
        const res = await axios.get(route("user.order.show", order));
        const orders = res.data.results;
        $("#m_order").modal("show"); // show modal
        let subtotal;
        let output = `  <div class="d-flex justify-content-between">
                            <p>Transaction No - ${orders[0].transaction_no}</p>
                            <p>Date - ${formatDate(
                                orders[0].created_at,
                                "full"
                            )}</p>
                        </div>
                        <p>My Order: </p>
                        <ul>`;
        orders.forEach((order) => {
            list_of_price.push(order.product.price);
            subtotal = list_of_price.reduce(getSum, 0);

            output += `  
                            <li>${order.product.name} - ₱ ${order.product.price}</li>
                      `;
        });

        output += `
                        </ul>
                        <p>Sub Total - ₱ ${subtotal}</p>
                        <p>Vat(%) - ${getPercentage(orders[0].tax.tax)} %</p>  
                    `;

        // check if there is a voucher discount

        if (orders[0].coupon) {
            output += ` <p>Coupon Discount - ${getPercentage(
                orders[0].coupon.discount
            )} % </p>`;
        }
        // calculate Total
        output += `<h6 class='font-weight-bold'> Total ₱ ${orders[0].amount_paid} </h6>`;

        $("#my_order").html(output);
    } catch (e) {
        log(e);
    }
}

async function c_index(dt, route, column) {
    //axios.get("/admin/transaction").then((res) => log(res));
    $(dt).DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        autoWidth: false,
        ajax: route,
        columns: column,
        dom: "Bfrtip",
        buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5", "print"],
    });
}
