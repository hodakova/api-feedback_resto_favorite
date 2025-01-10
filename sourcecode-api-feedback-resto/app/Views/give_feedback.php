<!DOCTYPE html>
<html lang="en">
    <body>
        <!-- HEADER: HEROE SECTION -->
        <header>
            <div class="heroe">
                <h1>Berikan feedback untuk cabang favoritmu!</h1>

                <h2>Terima kasih!</h2>
            </div>
        </header>

        <!-- CONTENT -->
        <section>
            <?php if (session()->getFlashdata('success')): ?>
                <div style="color: green;"><?= session()->getFlashdata('success'); ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div style="color: red;"><?= session()->getFlashdata('error'); ?></div>
            <?php endif; ?>

            <form action="/give_feedback/submitFeedback" method="post">
                <?= csrf_field(); ?>

                <label for="branch_id">Cabang:</label>
                <select name="branch_id" id="branch_id" required>
                    <option value="">Pilih cabang</option>
                    <?php foreach ($branches as $branch): ?>
                        <option value="<?= $branch['id']; ?>"><?= $branch['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <br>
                <label for="menu_item_id">Menu (optional):</label>
                <select name="menu_item_id" id="menu_item_id">
                    <option value="">Pilih menu</option>
                </select>
                <br>
                <br>
                <label for="rating">Rating (1-5):</label>
                <input type="number" name="rating" id="rating" min="1" max="5" required>
                <br>
                <br>
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment" placeholder="Tuliskan feedbackmu..."></textarea>
                <br>
                <br>
                <button type="submit">Submit Feedback</button>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </form>
        </section>
        <script>
            document.getElementById('branch_id').addEventListener('change', function () {
                const branchId = this.value;
                const menuItemSelect = document.getElementById('menu_item_id');

                if (branchId) {
                    fetch(`/give_feedback/getMenuItems/${branchId}`)
                        .then(response => response.json())
                        .then(data => {
                            menuItemSelect.innerHTML = '<option value="">Pilih menu</option>';
                            data.forEach(menu => {
                                const option = document.createElement('option');
                                option.value = menu.id;
                                option.textContent = menu.name;
                                menuItemSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Kesalahan saat mengambil menu:', error));
                } else {
                    menuItemSelect.innerHTML = '<option value="">Pilih menu</option>';
                }
            });
        </script>
    </body>
</html>
