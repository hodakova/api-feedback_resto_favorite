<!DOCTYPE html>
<html lang="en">
<body>
<!-- HEADER: HEROE SECTION -->
<header>
    <div class="heroe">
        <h1>Setiap feedbackmu bermakna!</h1>

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

    <?php if (empty($feedbacks)): ?>
        <p>You have not submitted any feedback yet.</p>
    <?php else: ?>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Branch</th>
                    <th>Menu Item</th>
                    <th>Price</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedbacks as $index => $feedback): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= $feedback['branch_name']; ?></td>
                        <td><?= $feedback['menu_item_name'] ?? 'N/A'; ?></td>
                        <td><?= isset($feedback['menu_price']) ? 'Rp ' . number_format($feedback['menu_price'], 0, ',', '.') : 'N/A'; ?></td>
                        <td><?= $feedback['rating']; ?></td>
                        <td><?= $feedback['comment'] ?? 'No comment'; ?></td>
                        <td><?= $feedback['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
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
    <br>
    <br>
    <br>
    <br>
</section>
</body>
</html>
