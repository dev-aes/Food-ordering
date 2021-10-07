// Global Fn()

function isNotEmpty(input) {
    if (input.val() == "") {
        input.addClass("is-invalid");
        return false;
    } else {
        input.removeClass("is-invalid");
        return true;
    }
}

function log(val) {
    return console.log(val);
}

function formatDate(date, opt) {
    if (opt == "full") {
        const formatted_date = new Date(date);
        return formatted_date.toLocaleDateString();
    }

    if (opt == "datetime") {
        const formatted_date = new Date(date);
        return formatted_date.toLocaleString();
    }
}

function isActivated(data) {
    return data
        ? `<span class='badge bg-success p-2 text-white text-uppercase'>Activated</span>`
        : `<span class='badge bg-secondary p-2 text-white text-uppercase'>Deactivated</span>`;
}

function getPercentage(value) {
    return value * 100;
}

function getSum(total, num) {
    // return Math.round(parseFloat(total) + parseFloat(num));
    return (parseFloat(total) + parseFloat(num)).toFixed(2);
}

// Global Alerts

function success(msg) {
    Swal.fire({
        icon: "success",
        title: `${msg}`,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
}

function error(msg) {
    Swal.fire({
        icon: "error",
        title: `${msg}`,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
}

function confirm() {
    return Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => result);
}
