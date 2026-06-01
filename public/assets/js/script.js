console.log("iRent Loaded");

document.addEventListener("DOMContentLoaded", function () {

    const payButton = document.getElementById("payButton");

    if (payButton) {

        payButton.addEventListener("click", function () {

            const popup = document.getElementById("success-popup");

            popup.classList.add("show");

            setTimeout(function () {

                window.location.href = "/katalog";

            }, 2000);

        });

    }

});