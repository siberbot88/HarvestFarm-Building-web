document.addEventListener('DOMContentLoaded', function() {
  // Filter produk berdasarkan kategori
  const filterSelect = document.getElementById('filter-kategori');
  if (filterSelect) {
      filterSelect.addEventListener('change', function() {
          filterProducts();
      });
  }
  
  // Validasi form
  const productForm = document.getElementById('product-form');
  if (productForm) {
      productForm.addEventListener('submit', function(e) {
          if (!validateForm()) {
              e.preventDefault();
          }
      });
  }
  
  // Modal konfirmasi hapus
  const deleteButtons = document.querySelectorAll('.btn-delete');
  deleteButtons.forEach(button => {
      button.addEventListener('click', function(e) {
          e.preventDefault();
          const productId = this.getAttribute('data-id');
          const productName = this.getAttribute('data-name');
          showDeleteConfirmation(productId, productName);
      });
  });
});

// Fungsi filter produk
function filterProducts() {
  const kategori = document.getElementById('filter-kategori').value;
  const products = document.querySelectorAll('.product-card');
  
  products.forEach(product => {
      if (kategori === 'semua' || product.getAttribute('data-category') === kategori) {
          product.style.display = 'block';
      } else {
          product.style.display = 'none';
      }
  });
}

// Validasi form
function validateForm() {
  let isValid = true;
  const nama = document.getElementById('nama');
  const kategori = document.getElementById('kategori');
  const harga = document.getElementById('harga');
  const stok = document.getElementById('stok');
  
  // Reset error messages
  const errorElements = document.querySelectorAll('.error-message');
  errorElements.forEach(element => {
      element.textContent = '';
  });
  
  // Validasi nama
  if (nama.value.trim() === '') {
      showError(nama, 'Nama produk tidak boleh kosong');
      isValid = false;
  }
  
  // Validasi kategori
  if (kategori.value === '') {
      showError(kategori, 'Pilih kategori produk');
      isValid = false;
  }
  
  // Validasi harga
  if (harga.value.trim() === '') {
      showError(harga, 'Harga produk tidak boleh kosong');
      isValid = false;
  } else if (isNaN(harga.value) || parseFloat(harga.value) <= 0) {
      showError(harga, 'Harga produk harus berupa angka positif');
      isValid = false;
  }
  
  // Validasi stok
  if (stok.value.trim() === '') {
      showError(stok, 'Stok produk tidak boleh kosong');
      isValid = false;
  } else if (isNaN(stok.value) || parseInt(stok.value) < 0) {
      showError(stok, 'Stok produk harus berupa angka positif atau nol');
      isValid = false;
  }
  
  return isValid;
}

// Tampilkan pesan error
function showError(input, message) {
  const formGroup = input.parentElement;
  const errorElement = formGroup.querySelector('.error-message');
  errorElement.textContent = message;
}

// Tampilkan modal konfirmasi hapus
function showDeleteConfirmation(id, name) {
  const modal = document.getElementById('delete-modal');
  const productNameSpan = document.getElementById('product-name');
  const confirmButton = document.getElementById('confirm-delete');
  
  productNameSpan.textContent = name;
  confirmButton.setAttribute('href', `delete.php?id=${id}`);
  
  modal.style.display = 'flex';
  
  // Tutup modal jika user klik di luar modal atau klik tombol batal
  window.onclick = function(event) {
      if (event.target === modal) {
          modal.style.display = 'none';
      }
  }
  
  const cancelButton = document.getElementById('cancel-delete');
  cancelButton.addEventListener('click', function() {
      modal.style.display = 'none';
  });
}