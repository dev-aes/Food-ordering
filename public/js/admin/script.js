$(() => {
    // check for the specifc url

    //category
    if (window.location.href === route("admin.category.index")) {
        const category_data = [
            { data: "name" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".category_dt"),
            route("admin.category.index"),
            category_data
        );
    }

    // tax

    if (window.location.href === route("admin.tax.index")) {
        const tax_data = [
            { data: "tax" },
            {
                data: "status",
                render(data) {
                    return isActivated(data);
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".tax_dt"), route("admin.tax.index"), tax_data);
    }

    // coupon

    if (window.location.href === route("admin.coupon.index")) {
        const coupon_data = [
            { data: "code" },
            {
                data: "discount",
                render(data) {
                    return getPercentage(data) + " %";
                },
            },
            {
                data: "status",
                render(data) {
                    return isActivated(data);
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".coupon_dt"), route("admin.coupon.index"), coupon_data);
    }

    // food product

    if (window.location.href === route("admin.product.index")) {
        const product_data = [
            { data: "name" },
            { data: "category.name" },
            { data: "price" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".product_dt"), route("admin.product.index"), product_data);
    }
});

// global variables
let tax = 0;
let list_of_price = [];

async function showOrder(order) {
    try {
        list_of_price = [];
        const res = await axios.get(route("admin.order.show", order));
        const orders = res.data.results;
        $("#m_admin_order").modal("show"); // show modal
        let subtotal;
        let output = `  <div class="d-flex justify-content-between">
                            <p>Transaction No - ${orders[0].transaction_no}</p>
                            <p>Date - ${formatDate(
                                orders[0].created_at,
                                "full"
                            )}</p>
                        </div>
                        <p>Ordered Food: </p>
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

        $("#admin_my_order").html(output);
    } catch (e) {
        log(e);
    }
}

//===============================================================================
// crud function

async function c_index(dt, route, column) {
    //axios.get("/admin/dashboard").then((res) => log(res));
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

// activate - deactivate status
function crud_activate_deactivate(id, route_name, value, dt, msg) {
    Swal.fire({
        title: `Do you want to ${msg}?`,
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: `Yes, ${value} it!`,
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .put(route(route_name, id), { option: value })
                .then((res) => {
                    $(dt).DataTable().draw();
                    return success(`${value} successfully`);
                })
                .catch((e) => {
                    error(e.response.data.message);
                });
        }
    });
}

// crud create
function toggle_modal(modal, form, modal_title, buttons, opt = "") {
    // if there is a last optional parameter then execute the query
    // opt [route_name, element target (where to append the data)]
    if (opt) {
        axios.get(route(opt.rname)).then((res) => {
            let data = `<option></option>`;
            res.data.results.forEach((result) => {
                data += `<option value='${result.id}'>${result.name}</option>`;
            });
            $(opt.target).html(data); // append the category data []
        });
    }

    $(modal).modal("show"); // show modal dialog
    $(form)[0].reset(); // clear input field
    $(modal_title[0]).html(
        `${modal_title[1]} <i class="fas fa-plus-circle"></i> `
    );
    $(".modal-header")
        .removeClass("bg-success")
        .addClass("bg-primary text-white");
    $(buttons[0]).css("display", "block"); // add button
    $(buttons[1]).css("display", "none"); // update button
}

async function c_store(form, dt, route_name) {
    //Validation

    // Validation
    let bool;

    $(`${form} *`)
        .filter(":input")
        .each(function () {
            // loop through each element & apply sanitation
            if (isNotEmpty($(this))) {
                bool = true;
            } else {
                bool = false;
                return false;
            }
        });

    if (bool) {
        // convert the first form in the parameter into a form data object
        const form_data = new FormData($(form)[0]);

        try {
            // request
            const res = await axios.post(route(route_name), form_data);
            success(res.data.message);
            $(form)[0].reset(); // clear input field
            $(dt).DataTable().draw(); // update dt
        } catch (e) {
            const errors = Object.values(e.response.data.errors);
            errors.forEach((e) => {
                error(e);
            });
        }
    }
}

// crud edit
function c_edit(modal, form, modal_title, buttons, model, opt = "") {
    if (opt) {
        // if there is an optional parameter then execute the query
        // opt [route_name, element target (where to append the data)]
        if (opt) {
            axios.get(route(opt.rname)).then((res) => {
                let data = `<option value='${model.category_id}'>${model.category.name} (Current)</option>`;
                res.data.results.forEach((result) => {
                    data += `<option value='${result.id}'>${result.name}</option>`;
                });
                $(opt.target).html(data); // append the category data []
            });
        }
    }

    // continue
    $(modal).modal("show");
    $(".yes").attr("checked", false); // clear first
    $(".no").attr("checked", false);
    $(".modal-header")
        .removeClass("bg-primary")
        .addClass("bg-success text-white");
    $(modal_title[0]).html(`${modal_title[1]} <i class="fas fa-edit"></i> `);
    $(buttons[0]).css("display", "none"); // add button
    $(buttons[1]).css("display", "block").attr("data-id", model.id); // show update button and append a model id to it

    const key_val = Object.entries(model); // ex output (6) [ 0:{0:id, 1:test}, 1:{0:id, 1:test2}]

    const form_field = $(form); // get all input field inside a form

    // loop each input fields and find its match input name to the model instance
    form_field.each((key, val) => {
        key_val.forEach((k) => {
            if (
                val.type == "text" ||
                val.type == "number" ||
                val.type == "select-one" ||
                val.type == "radio"
            ) {
                // check if the input type name is equal to the database key ex input name='email' db column name = email
                if (k[0] == val.name) {
                    //check if its not a radio button
                    // append a value
                    if (val.type !== "radio") {
                        val.value = k[1];
                    } else {
                        // if the value of the radio buttons are set to true . assign checked prop to the 'yes' radio btn
                        if (k[1] == 1) {
                            $(".yes").attr("checked", true);
                        } else {
                            // else assign checked prop to the 'no' radio btn
                            $(".no").attr("checked", true);
                        }
                    }
                }
            }
        });
    });
}

// crud update
async function c_update(form, dt, route_name, e) {
    // convert the first form in the parameter into a form data object
    const form_data = new FormData($(form)[0]);
    form_data.append("_method", "PUT");
    const model_id = e.target.getAttribute("data-id");

    try {
        // request
        const res = await axios.post(
            `${route(route_name, model_id)}`,
            form_data
        ); // fake update request
        success(res.data.message);
        $(dt).DataTable().draw(); // update dt
    } catch (e) {
        log(e);
        error(e.response.data.message);
    }
}

// crud destroy
async function c_destroy(id, routename, dt) {
    const result = await confirm();
    if (result.isConfirmed) {
        try {
            const res = await axios.delete(route(routename, id));
            success(res.data.message);
            $(dt).DataTable().draw(); // update dt
        } catch (e) {
            log(e);
        }
    }
}
