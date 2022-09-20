<?php

use Illuminate\Support\Facades\Session;

$id = 'ID_' . Illuminate\Support\Str::random(20);
$name = Illuminate\Support\Str::slug($block->setting('label'));

$errors = Session::get('errors', new Illuminate\Support\MessageBag);
?>
<div class="form-group">
    <label for="<?= $id ?>" class="form-label <?= $block->setting('required') ? 'required' : '' ?>">
        <?= $block->setting('label') ?>
    </label>

    <input type="hidden" name="<?= $name ?>[label]" value="<?= $block->setting('label') ?>">
    <input type="text" name="<?= $name ?>[value]" id="<?= $id ?>" <?= $block->setting('required') ? 'required="required"' : '' ?> class="form-control <?= $errors->has($name) ? 'has-error' : '' ?>" value="<?= e(old($name)['value'] ?? null) ?>">

    <?php
    if ($errors->has($name)) :
    ?>
        <span class="help-block">
            <strong><?= e($errors->first($name)) ?></strong>
        </span>
    <?php
    endif;
    ?>
</div>