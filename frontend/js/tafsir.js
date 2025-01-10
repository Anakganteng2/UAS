// Ambil parameter nomor surat dari URL
const urlParams = new URLSearchParams(window.location.search);
const nomorSurat = urlParams.get("nomorsurat");

// Fungsi untuk menampilkan loading indicator
function showLoading() {
  document.getElementById("tafsir-content").innerHTML = "<p>Loading...</p>";
}

// Fungsi untuk menampilkan pesan kesalahan
function showError(message) {
  document.getElementById(
    "tafsir-content"
  ).innerHTML = `<p class='text-danger'>${message}</p>`;
}

// Ambil data tafsir dari API
async function getTafsir() {
  showLoading(); // Tampilkan loading indicator

  try {
    // Fetch nama surat dari API lokal
    const suratResponse = await fetch(`http://127.0.0.1:8000/api/apiqu`);
    if (!suratResponse.ok) {
      throw new Error("Network response was not ok");
    }
    const suratData = await suratResponse.json();
    const surat = suratData.data.find(surat => surat.nomorSurat == nomorSurat);

    if (surat) {
      const { namaLatin } = surat;

      // Tampilkan nama surat
      document.getElementById(
        "nama-surat"
      ).textContent = `Tafsir Surat ${namaLatin}`;

      // Fetch tafsir dari API lokal
      const tafsirResponse = await fetch(`http://127.0.0.1:8000/api/tafsir/${nomorSurat}`);
      if (!tafsirResponse.ok) {
        throw new Error("Network response was not ok");
      }
      const tafsirData = await tafsirResponse.json();

      // Pastikan struktur respons API
      if (tafsirData && tafsirData.data) {
        const tafsirHTML = tafsirData.data
          .map(
            (ayat) => `
                  <div class="mb-4">
                      <h5>Ayat ${ayat.nomorAyat}</h5>
                      <p>${ayat.teksTafsir}</p>
                  </div>
              `
          )
          .join("");
        document.getElementById("tafsir-content").innerHTML = tafsirHTML;
      } else {
        showError("Data tafsir tidak tersedia.");
      }
    } else {
      showError("Surat tidak ditemukan.");
    }
  } catch (error) {
    console.error("Error fetching tafsir:", error);
    showError("Gagal memuat tafsir. Silakan coba lagi nanti.");
  }
}

// Panggil fungsi untuk mengambil tafsir
getTafsir();
