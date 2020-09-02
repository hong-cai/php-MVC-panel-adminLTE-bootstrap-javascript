<?php
require PRIVATE_PATH . '/views/inc/header.php';
?>
<div class="admin-content-wrapper">
    <h3> <?php echo $data['error_msg']; ?> . You will be redirect to
        <a href="<?php echo URL . '/users/index'; ?>"> Dashboard </a> in <span id="counter"
            class="text-danger">3</span>second(s)..
    </h3>
</div>
<!--/conent-wrapper-->

<?php
require PRIVATE_PATH . '/views/inc/footer.php';
?>
;