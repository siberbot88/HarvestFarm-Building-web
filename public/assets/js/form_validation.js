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