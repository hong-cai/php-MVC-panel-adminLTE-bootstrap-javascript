<?php
require PRIVATE_PATH . '/views/inc/header.php';
?>
<div class="content-range">
    <!-- Main content -->
    <div class="col-6">
        <h4>Edit the note:</h4>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-info">
                    <!-- /.card-header -->
                    <div class="card-body pad">
                        <form action="<?php echo URL . '/notes/edit/' . $data['id']; ?>" method="post">
                            <div class="form-group form-inline">
                                <label class="mx-2" for="note-title">Title:</label>
                                <input type="text" value="<?php echo htmlspecialchars_decode($data['title']); ?>"
                                    class="form-control flex-fill   <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                                    name="title" placeholder="title..." id="note-title" />
                                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                            </div>
                            <div class="form-group form-inline">

                                <label class="mx-2" for="note-title">Category:</label>
                                <select id="cat-select" class="form-control mx-2" name="category">
                                    <?php foreach ($data['categories'] as $cat) {
    ;?>
                                    <option value="<?php echo htmlspecialchars_decode($cat->category); ?>"
                                        <?php echo htmlspecialchars_decode($cat->category) === htmlspecialchars_decode($data['category']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars_decode($cat->category); ?>
                                    </option>
                                    <?php }
;?>
                                </select>
                                <input type="text" class="form-control mx-2" placeholder="category" id="add-category" />
                                <button type="button" class="btn btn-info float-right" id="add-btn"> Add
                                </button>
                            </div>
                            <div class="mb-3">
                                <textarea name="body"  id="editor"
                                    class="textarea <?php echo !empty($data['body_err']) ? 'is-invalid' : ''; ?>">
                                        <?php echo $data['body']; ?>
                                    </textarea>
                                <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                            </div>
                            <a href=" <?php echo URL . '/notes'; ?> " class="btn btn-info ">Back </a>
                            <input type="submit" class="btn btn-danger pull-right" value='Update' name="submit" />
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
</div>
<?php require PRIVATE_PATH . '/views/inc/footer.php';?>