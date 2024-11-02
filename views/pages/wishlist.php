<?php require 'views/partials/header.php'; ?>

<main class="container my-5">
    <h1 class="text-center mb-5">Wishlist</h1>

    <!-- Display wishlist products -->
    <div class="row">
        <?php if (!empty($wishlistItems)) : ?>
            <?php foreach ($wishlistItems as $item) : ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm border-0">

                        <!-- Display product image if available -->
                        <?php if (!empty($item['product_image'])) : ?>
                            <img src="public/images/products/<?php echo htmlspecialchars($item['product_image']); ?>" class="card-img-top rounded" alt="Product Image" style="max-height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <h5 id="wishlistProductTitle" class="card-title" style="color: black !important; "><?php echo htmlspecialchars($item['title']); ?></h5>                            <p class="card-text text-muted"><?php echo htmlspecialchars($item['description']); ?></p>
                            <p class="card-text"><strong>Price:</strong> $<?php echo htmlspecialchars($item['price']); ?></p>
                            <p class="card-text"><strong>Quantity Available:</strong> <?php echo htmlspecialchars($item['product_quantity']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">Your wishlist is currently empty.</p>
        <?php endif; ?>
    </div>

</main>



<!-- Modal for delete confirmation -->
<!-- <div id="deleteModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-body text-center">
            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
            <h5>Are you sure you want to delete this product from your wishlist?</h5>
            <form id="deleteForm" action="/wishlist/delete" method="POST">
                <input type="hidden" name="id" id="deleteProductId">
                <button type="button" class="btn btn-secondary mr-2" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div> -->
<?php


?>
<?php require 'views/partials/footer.php'; ?>

<!-- Inline styles for modal and animations -->
<style>
    /* Modal styles */
    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        animation: fadeIn 0.3s ease;
    }
    .modal-body {
        text-align: center;
    }
    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        cursor: pointer;
    }
    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<!-- Inline JavaScript for modal functionality -->
<!-- <script>
    // Open modal with product ID
    function confirmDelete(productId) {
        document.getElementById('deleteProductId').value = productId;
        document.getElementById('deleteModal').style.display = 'flex';
    }

    // Close modal
    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    // Close modal when clicking outside of modal-content
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target == modal) {
            closeModal();
        }
    };
</script> -->
