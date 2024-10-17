document.addEventListener("DOMContentLoaded", function () {
    const userName = document.getElementById("userData").dataset.username;
    const takeCaptureButton = document.getElementById("takecapture");
    takeCaptureButton.addEventListener("click", function () {
        // Nonaktifkan tombol setelah klik pertama
        takeCaptureButton.disabled = true;
        setTimeout(() => {}, 2000);
    });
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
        // Disable the absen button
        document.getElementById("takecapture").disabled = true;
    }

    function showPosition(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        const map = L.map("map").setView([lat, lon], 13);
        var marker = L.marker([lat, lon]).addTo(map);
        document.getElementById("location").value = `${lat},${lon}`;

        L.tileLayer("http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}", {
            maxZoom: 20,
            subdomains: ["mt0", "mt1", "mt2", "mt3"],
        }).addTo(map);

        map.on("click", function (e) {
            L.popup().setLatLng(e.latlng).setContent(userName).openOn(map);
        });

        // Enable the absen button after location is retrieved
        document.getElementById("takecapture").disabled = false;
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert(
                    "User denied the request for Geolocation. Aktifkan layanan lokasi untuk melanjutkan absen."
                );
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }

        // Disable the absen button if location is not available
        document.getElementById("takecapture").disabled = true;
    }

    $(document).ready(function () {
        Webcam.set({
            width: 400,
            height: 300,
            image_format: "jpeg",
            jpeg_quality: 90,
        });

        Webcam.attach("#webcam");

        $("#takecapture").click(function (e) {
            // Cek apakah lokasi sudah ada
            const location = $("#location").val();

            if (!location) {
                alert(
                    "Tidak dapat melakukan absen, layanan lokasi tidak aktif."
                );
                return;
            }

            Webcam.snap(function (uri) {
                const image = uri;
                const userId = $("#userData").data("userid");
                const status = $("#status").val();
                const reason = $("#reason").val();
                const csrfToken = $('meta[name="csrf-token"]').attr("content");

                $.ajax({
                    type: "POST",
                    url: "/dashboard/store",
                    data: {
                        _token: csrfToken,
                        image: image,
                        user_id: userId,
                        location: location,
                        status: status,
                        reason: reason,
                    },
                    cache: false,
                    success: function (response) {
                        var statusPopup = response.split("|");
                        if (statusPopup[0] == "success") {
                            Swal.fire("Absen Success!").then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "/dashboard/";
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: "Maaf Gagal Absen, Silahkan Hubungi Admin",
                                icon: "error",
                            });
                        }
                    },
                });
            });
        });
    });
});

function updateTime() {
    const currentTimeElement = document.getElementById("current_time");

    // Mendapatkan waktu saat ini
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, "0");
    const minutes = now.getMinutes().toString().padStart(2, "0");
    const seconds = now.getSeconds().toString().padStart(2, "0");
    const day = now.getDate().toString().padStart(2, "0");
    const month = (now.getMonth() + 1).toString().padStart(2, "0"); // Bulan mulai dari 0
    const year = now.getFullYear();

    // Format waktu dan tanggal
    const formattedTime = `${hours}:${minutes}:${seconds}`;
    const formattedDate = `${day}-${month}-${year}`;

    // Menampilkan waktu dan tanggal pada elemen
    currentTimeElement.textContent = `${formattedDate} || ${formattedTime}`;
}

// Memperbarui waktu setiap detik
setInterval(updateTime, 1000);

// Panggil fungsi sekali saat halaman pertama kali dimuat
updateTime();
