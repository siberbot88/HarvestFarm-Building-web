<?php include '../views/partials/header.php'; ?>

<div class="container mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold mb-6">Daftar Produk</h1>
  
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php foreach($products as $product): ?>
    <div class="bg-white rounded-lg shadow-md p-6">
      <img src="/public/uploads/<?= $product->image ?>" 
           class="w-full h-48 object-cover mb-4 rounded">
      <h2 class="text-xl font-semibold mb-2"><?= $product->name ?></h2>
      <p class="text-gray-600 mb-2">Rp <?= number_format($product->price, 0, ',', '.') ?></p>
      <div class="flex gap-2">
        <a href="/products/<?= $product->id ?>" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          Detail
        </a>
        <a href="/products/<?= $product->id ?>/edit" 
           class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
          Edit
        </a>
        <form action="/products/<?= $product->id ?>/delete" method="POST">
          <button type="submit" 
                  class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                  onclick="return confirm('Yakin ingin menghapus?')">
            Hapus
          </button>
        </form>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include '../views/partials/footer.php'; ?>