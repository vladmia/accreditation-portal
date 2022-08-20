<?php if (count($errors) > 0) : ?>

<div class="errors">
    <?php foreach ($errors as $error) : ?>
        <p><?php echo '&middot; ' . $error ?></p>
    <?php endforeach ?>
</div>

<?php endif ?>