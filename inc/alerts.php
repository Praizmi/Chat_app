<!-- <?//php// if($success) : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-thumb-up me-1"></i>
    <?php //echo $success; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php //endif ?>

<?//php// if($error) : ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <i class="fa fa-thumb-down me-1"></i>
    <?php //echo $error; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php //endif ?> -->

<?php if(isset($_SESSION['msg'])) : ?>
<div class="alert alert-secondary alert-dismissible" role="alert">
    <i class="fa fa-thumb-down me-1"></i>
    <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif ?>

<?php if(isset($_SESSION['loginMsg'])) : ?>
<div class="alert alert-info alert-dismissible" role="alert">
    <i class="fa fa-thumb-down me-1"></i>
    <?php echo $_SESSION['loginMsg']; unset($_SESSION['loginMsg']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif ?>