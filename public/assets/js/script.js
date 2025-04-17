// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
  // Category filter handling - auto-submit on change
  const categorySelect = document.getElementById('category_id');
  if (categorySelect) {
      categorySelect.addEventListener('change', function() {
          document.getElementById('filterForm').submit();
      });
  }

  // Delete product confirmation
  const deleteModal = document.getElementById('deleteModal');
  const confirmDeleteBtn = document.getElementById('confirmDelete');
  const cancelDeleteBtn = document.getElementById('cancelDelete');
  
  // Store the product ID to be deleted
  let productIdToDelete = null;

  // Function to open the delete confirmation modal
  window.confirmDelete = function(productId) {
      productIdToDelete = productId;
      deleteModal.classList.add('show');
  };

  // Function to close the delete confirmation modal
  function closeDeleteModal() {
      deleteModal.classList.remove('show');
  }

  // Event listener for cancel button
  if (cancelDeleteBtn) {
      cancelDeleteBtn.addEventListener('click', closeDeleteModal);
  }

  // Event listener for confirm delete button
  if (confirmDeleteBtn) {
      confirmDeleteBtn.addEventListener('click', function() {
          if (productIdToDelete) {
              // Send AJAX request to delete product
              fetch(`delete_product.php?id=${productIdToDelete}`, {
                  method: 'GET',
                  headers: {
                      'Content-Type': 'application/json'
                  }
              })
              .then(response => response.json())
              .then(data => {
                  closeDeleteModal();
                  if (data.success) {
                      // Redirect to home page or reload current page
                      window.location.href = 'index.php?success=3';
                  } else {
                      alert('Error: ' + data.message);
                  }
              })
              .catch(error => {
                  closeDeleteModal();
                  alert('Error: ' + error.message);
              });
          }
      });
  }

  // Close modal when clicking outside of modal content
  window.addEventListener('click', function(event) {
      if (event.target === deleteModal) {
          closeDeleteModal();
      }
  });

  // Success messages handling
  const urlParams = new URLSearchParams(window.location.search);
  const successParam = urlParams.get('success');
  
  if (successParam) {
      let message = '';
      
      switch (successParam) {
          case '1':
              message = 'Produk berhasil ditambahkan!';
              break;
          case '2':
              message = 'Produk berhasil diperbarui!';
              break;
          case '3':
              message = 'Produk berhasil dihapus!';
              break;
      }
      
      if (message) {
          // Create and show success message
          const alertDiv = document.createElement('div');
          alertDiv.className = 'alert alert-success';
          alertDiv.textContent = message;
          
          const mainElement = document.querySelector('main');
          if (mainElement) {
              mainElement.insertBefore(alertDiv, mainElement.firstChild);
              
              // Auto remove after 5 seconds
              setTimeout(function() {
                  alertDiv.remove();
              }, 5000);
          }
      }
  }
});
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('productForm');
  if (!form) return;

  // Element references
  const nameInput = document.getElementById('name');
  const descriptionInput = document.getElementById('description');
  const priceInput = document.getElementById('price');
  const stockInput = document.getElementById('stock');
  const categoryInput = document.getElementById('category_id');
  const imageInput = document.getElementById('image');
  const imagePreview = document.getElementById('imagePreview');

  // Validation functions
  function validateName() {
      const value = nameInput.value.trim();
      if (!value) {
          showError(nameInput, 'Nama produk harus diisi');
          return false;
      }
      clearError(nameInput);
      return true;
  }

  function validateDescription() {
      const value = descriptionInput.value.trim();
      if (!value) {
          showError(descriptionInput, 'Deskripsi harus diisi');
          return false;
      }
      clearError(descriptionInput);
      return true;
  }

  function validatePrice() {
      const value = priceInput.value.trim();
      if (!value) {
          showError(priceInput, 'Harga harus diisi');
          return false;
      }
      const num = parseFloat(value);
      if (isNaN(num) || num <= 0) {
          showError(priceInput, 'Harga harus berupa angka positif');
          return false;
      }
      clearError(priceInput);
      return true;
  }

  function validateStock() {
      const value = stockInput.value.trim();
      if (!value) {
          showError(stockInput, 'Stok harus diisi');
          return false;
      }
      const num = parseInt(value, 10);
      if (isNaN(num) || num < 0) {
          showError(stockInput, 'Stok harus berupa angka non-negatif');
          return false;
      }
      clearError(stockInput);
      return true;
  }

  function validateCategory() {
      const value = categoryInput.value;
      if (value === "") {
          showError(categoryInput, 'Kategori harus dipilih');
          return false;
      }
      clearError(categoryInput);
      return true;
  }

  function validateImage() {
      if (imageInput.files.length > 0) {
          const file = imageInput.files[0];
          const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
          const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
          const maxSize = 5 * 1024 * 1024; // 5MB
          const extension = file.name.split('.').pop().toLowerCase();

          if (!allowedTypes.includes(file.type) || !allowedExtensions.includes(extension)) {
              showError(imageInput, 'Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan');
              return false;
          }

          if (file.size > maxSize) {
              showError(imageInput, 'Ukuran file terlalu besar (maksimal 5MB)');
              return false;
          }
      }
      clearError(imageInput);
      return true;
  }

  // Image preview handler
  imageInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      imagePreview.innerHTML = '';
      
      if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
              const img = document.createElement('img');
              img.src = e.target.result;
              img.className = 'thumbnail';
              img.alt = 'Preview';
              imagePreview.appendChild(img);
          };
          reader.readAsDataURL(file);
      }
      validateImage();
  });

  // Real-time validation
  nameInput.addEventListener('input', validateName);
  descriptionInput.addEventListener('input', validateDescription);
  priceInput.addEventListener('input', validatePrice);
  stockInput.addEventListener('input', validateStock);
  categoryInput.addEventListener('change', validateCategory);

  // Form submission handler
  form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const isValid = [
          validateName(),
          validateDescription(),
          validatePrice(),
          validateStock(),
          validateCategory(),
          validateImage()
      ].every(valid => valid);

      if (isValid) {
          form.submit();
      }
  });

  // Error handling utilities
  function showError(input, message) {
      const formGroup = input.closest('.form-group');
      let errorElement = formGroup.querySelector('.error');
      
      // Create error element if doesn't exist
      if (!errorElement) {
          errorElement = document.createElement('span');
          errorElement.className = 'error';
          formGroup.appendChild(errorElement);
      }
      
      errorElement.textContent = message;
      input.style.borderColor = '#d32f2f';
  }

  function clearError(input) {
      const formGroup = input.closest('.form-group');
      const errorElement = formGroup.querySelector('.error');
      
      if (errorElement) {
          errorElement.remove();
      }
      input.style.borderColor = '#e0e0e0';
  }
});