// Contoh validasi client-side
document.querySelector('form').addEventListener('submit', (e) => {
    const price = document.querySelector('input[name="price"]');
    if (price.value <= 0) {
      e.preventDefault();
      alert('Harga tidak valid!');
      price.focus();
    }
  });
  
  // Contoh AJAX untuk pencarian produk
  document.getElementById('search').addEventListener('input', async (e) => {
    const response = await fetch(`/api/products?q=${e.target.value}`);
    const products = await response.json();
    updateProductList(products);
  });