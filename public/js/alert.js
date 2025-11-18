function showAlert(type, message, duration = 3000) {
    const alert = document.createElement("div");

    // Warna dan ikon berdasarkan tipe
    const bgColor = {
        info: "bg-blue-100 text-blue-700 dark:bg-blue-200 dark:text-blue-800 z-50",
        success:
            "bg-green-100 text-green-700 dark:bg-green-200 dark:text-green-800",
        danger: "bg-red-100 text-red-700 dark:bg-red-200 dark:text-red-800",
        warning:
            "bg-yellow-100 text-yellow-700 dark:bg-yellow-200 dark:text-yellow-800",
    };

    const iconClass = {
        info: "fas fa-info-circle",
        success: "fas fa-check-circle",
        danger: "fas fa-exclamation-circle",
        warning: "fas fa-exclamation-triangle",
    };

    alert.className = `flex items-center p-3 mb-4 rounded-lg shadow-md fixed top-4 right-4 z-50 w-auto max-w-sm transition-all ${
        bgColor[type] || bgColor.info
    }`;
    alert.setAttribute("role", "alert");

    alert.innerHTML = `
        <i class="${iconClass[type] || iconClass.info} self-center text-lg"></i>
        <div class="ml-3 text-sm font-medium flex-1">${message}</div>
        <button type="button" class="ml-auto bg-transparent text-inherit hover:opacity-75 focus:outline-none alert-close">
            <i class="icofont-close text-lg"></i>
        </button>
    `;

    document.body.appendChild(alert);

    // Auto remove after duration
    const timeout = setTimeout(() => alert.remove(), duration);

    // Manual close
    alert.querySelector(".alert-close").addEventListener("click", () => {
        clearTimeout(timeout);
        alert.remove();
    });
}

function alertSuccess(msg, duration = 3000) {
    showAlert("success", msg, duration);
}

function alertDanger(msg, duration = 3000) {
    showAlert("danger", msg, duration);
}

// loop error
function loopErrors(errors) {
    $(".invalid-feedback").remove();
    if (errors == undefined) {
        return;
    }
    for (error in errors) {
        $("[name=" + error + "]").addClass("is-invalid text-red-600");

        $(
            '<span class="error text-red-600 invalid-feedback">' +
                errors[error][0] +
                "</span>"
        ).insertAfter($("[name=" + error + "]"));
        if (errors[error] === "Invalid credentials") {
            alertNotify("error", "Username atau Password Salah");
        }
    }
}
