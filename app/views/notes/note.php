<?php
require PRIVATE_PATH . '/views/inc/header.php';?>
<div class="admin-content-wrapper">
    <div class="content-range">
        <div class="row">
            <div class="col-11 note m-lg-2 p-2 h-100">
                <!-- Primary box -->
                <div class="box box-primary p-3">
                    <div class="box-header" data-toggle="tooltip" title="Header tooltip">
                        <h3 class="box-title">
                            <a href="<?php echo URL . '/notes/note/' . $data['id']; ?>">
                                <strong>
                                    <?php echo $data['title']; ?>
                                </strong>
                            </a>
                        </h3>
                        <div class="col-12">
                            <span>
                                <small><b>Category:</b><?php echo $data['category']; ?></small></span>
                            <span> <small><b>Created:</b><?php echo $data['created_at']; ?></small></span>
                        </div>
                    </div>
                    <div class="box-body p-5 h-100">
                        <p>
                            <?php echo html_entity_decode($data['body']); ?>
                        </p>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                    </div><!-- /.box-footer-->
                    <div class="box-tools">
                        <button style="<?php echo ($role!=='admin')?'pointer-events:none;':'';?>"
                            class="btn btn-<?php echo ($role!=='admin')?'secondary':'warning'  ;?>"><a
                                class="text-white"
                                href="<?php echo URL . '/notes/edit/' . $data['id']; ?>">Edit</a></button>


                        <button type="button"
                            class="btn btn-<?php echo (isset($_SESSION['user_id']) && $_SESSION['user_role']!=='admin')?'secondary':'danger'  ;?> delete-note"
                            data-toggle="modal" data-target="#noteDeleteModal"
                            style="<?php echo ($role!=='admin')?'pointer-events:none;':'';?>">delete</button>


                        <!-- Modal -->
                        <!-- <div class="delete-modal-wrapper"> -->
                        <div class="modal fade" id="noteDeleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="#noteDeleteModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close delete-close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        This note will be deleted?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary delete-close"
                                            data-dismiss="modal">No</button>
                                        <form class="d-inline"
                                            action="<?php echo URL . '/notes/delete/' . $data['id']; ?>" method="post">
                                            <input value="Delete" type="submit" class="btn btn-danger" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>

                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
    </div>
</div>
<?php
require PRIVATE_PATH . '/views/inc/footer.php';?>