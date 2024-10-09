const body = document.querySelector("body"),
    sidebar = body.querySelector("nav"),
    toggle = body.querySelector(".toggle"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");
mainContent = document.querySelector(".main-content");

toggle.addEventListener("click", function () {
    sidebar.classList.toggle("close");
    if (sidebar.classList.contains("close")) {
        mainContent.style.marginLeft = "88px"; // 88px for sidebar + 5px gap
    } else {
        mainContent.style.marginLeft = "200px"; // 250px for sidebar + 5px gap
    }
});

$(document).ready(function () {
    $(".status-btn").click(function (event) {
        event.preventDefault();

        var status = $(this).data("status");
        var token = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: "{{ route('dashboard.status') }}",
            type: "POST",
            data: {
                _token: token,
                status: status,
            },
            success: function (response) {
                alert(response.success);
                if (status === "Hadir") {
                    window.location.href = "/dashboard/create";
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            },
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const wfaBtn = document.getElementById("wfaBtn");

    wfaBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Mencegah link langsung diakses

        Swal.fire({
            title: "Input Keterangan WFA",
            input: "textarea",
            inputLabel: "Keterangan Work Form Anyware",
            inputPlaceholder: "Enter your reason here",
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return "You need to write something!";
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                const reason = result.value;
                const baseUrl = wfaBtn.getAttribute("data-url");
                const url = `${baseUrl}&reason=${encodeURIComponent(reason)}`;
                window.location.href = url;
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const izinBtn = document.getElementById("izinBtn");

    izinBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Mencegah link langsung diakses

        Swal.fire({
            title: "Input Keterangan Izin",
            input: "textarea",
            inputLabel: "Keterangan Izin",
            inputPlaceholder: "Enter your reason here",
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return "You need to write something!";
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                const reason = result.value;
                const baseUrl = izinBtn.getAttribute("data-url");
                const url = `${baseUrl}&reason=${encodeURIComponent(reason)}`;
                window.location.href = url;
            }
        });
    });
});

document
    .getElementById("fileuploadInput")
    .addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (event) {
                const imagePreview = document.getElementById("imagePreview");
                imagePreview.setAttribute("src", event.target.result);
                imagePreview.style.display = "block"; // Tampilkan gambar
            };

            reader.readAsDataURL(file);
        }
    });

    
