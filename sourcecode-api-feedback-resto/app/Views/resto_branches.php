<!DOCTYPE html>
<html lang="en">
<body>

<!-- HEADER: HEROE SECTION -->
<header>
    <div class="heroe">
        <h1>Daftar Cabang Resto Favoritmu dan Detailnya!</h1>

        <h2>Daftar menu dan feedback untuk setiap cabang favoritmu!</h2>
    </div>
</header>

<!-- CONTENT -->
<section>
<?php foreach ($branches as $branch): ?>
    <div>
        <h2 style="font-size: 2rem;"><?= $branch['branch']['name']; ?></h2>
        <p>ID Cabang: <?= $branch['branch']['id']; ?></p>
        <p>Lokasi: <?= $branch['branch']['location']; ?></p>

        <?php if (!empty($branch['branch_feedbacks'])): ?>
            <h3>Feedback untuk Cabang:</h3>
            <ul>
                <?php foreach ($branch['branch_feedbacks'] as $feedback): ?>
                    <li>
                        <strong><?= $feedback['user_name']; ?>:</strong>
                        <?= $feedback['comment']; ?> (Rating: <?= $feedback['rating']; ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($branch['menus'])): ?>
            <h3>Menu:</h3>
            <ul>
                <?php foreach ($branch['menus'] as $menu): ?>
                    <li>
                        <strong><?= $menu['name']; ?></strong>
                        <p>ID Menu: <?= $menu['id']; ?></p>
                        <p>Harga: Rp<?= number_format($menu['price'], 0, ',', '.'); ?><p>

                        <?php if (!empty($menu['menu_feedbacks'])): ?>
                            <ul>
                                <?php foreach ($menu['menu_feedbacks'] as $menuFeedback): ?>
                                    <li>
                                        <strong><?= $menuFeedback['user_name']; ?>:</strong>
                                        <?= $menuFeedback['comment']; ?> (Rating: <?= $menuFeedback['rating']; ?>)
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <br>
                        <br>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</section>
</body>
</html>