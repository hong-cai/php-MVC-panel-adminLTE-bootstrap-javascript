<?php
require PRIVATE_PATH . '/views/inc/header.php'; ?>
<div class="page-header">
    <h4> <?php echo $data['title']; ?></h4>
    <?php flash('post_message'); ?>
    <!-- search form -->
    <div class="col-12 col-md-6">
        <form action="<?php echo URL . '/notes/search'; ?>" method="post" class="sidebar-form" id="search-form"
            enctype="multipart/form-data">
            <div class="input-group">
                <input type="text" name='q' id='search-input' class="form-control input-sm" placeholder="Search..." />
                <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat btn-info" disabled value="submit"><i
                            class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
    </div>
    <div class="col-12 my-3">
        Filter:
        <div class="form-group form-inline filter-cat">
            <?php foreach ($data['categories'] as $cat) :; ?>
            <input type="button" data-id="<?php echo strtolower($cat->category) ?>" name="<?php echo $cat->category; ?>"
                value="<?php echo $cat->category; ?>" class="btn ml-2 text-white my-1">
            <?php endforeach; ?>
        </div>
    </div>
</div>

<ul class="content-range notes-list">
    <?php
    foreach ($data['notes'] as $note) {; ?>
    <li class="col-11 note p-2 mb-4">
        <!-- Primary box -->
        <div class="box box-primary box-solid p-3">
            <div class="box-header" data-toggle="tooltip" title="Header tooltip">
                <h4 class="box-title">
                    <a href="<?php echo URL . '/notes/note/' . $note->id; ?>">
                        <strong>
                            <?php echo html_entity_decode($note->title); ?>
                        </strong>
                    </a>
                </h4>
                <div class="col-12">
                    <span class="col-6">
                        <small><b>Category:</b><?php echo html_entity_decode($note->category); ?></small></span>
                    <span class="col-6"> <small><b>Created:</b><?php echo $note->created_at; ?></small></span>
                </div>
            </div>
            <div class="box-body">
                <p>
                    <?php echo html_entity_decode($note->content, ENT_QUOTES); ?>
                </p>
            </div><!-- /.box-body -->
            <div class="box-tools">
                <a role="button" class="btn text-light <?php
                                                            echo $role !== 'admin' ? 'bg-secondary' : 'bg-success'; ?>"
                    data-widget="edit"
                    href="<?php echo $role !== 'admin' ? 'javascript:void(0);' : (URL . '/notes/edit/' . $note->id); ?>"
                    style="<?php if ($role !== 'admin') {
                                                                                                                                                                                                                                                            echo "pointer-events:none;";
                                                                                                                                                                                                                                                        } ?>">Edit</a>


                <a class="btn btn-primary text-light" data-widget="read-more" role="button"
                    href="<?php echo URL . '/notes/note/' . $note->id; ?>">Read More</a>
            </div>
        </div><!-- /.box -->
    </li><!-- /.col -->
    <?php };
    ?>
</ul>
</div>
<?php
require PRIVATE_PATH . '/views/inc/footer.php'; ?>