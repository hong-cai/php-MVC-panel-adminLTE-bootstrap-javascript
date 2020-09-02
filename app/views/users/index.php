<?php
require PRIVATE_PATH . '/views/inc/header.php';
?>

<div class="content-range">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-xl-4 col-md-6 col-10 mx-auto">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa fa-sticky-note"
                                aria-hidden="true"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                <h5> <a href="<?php echo URL . '/notes/index'; ?>">Number of
                                        Notes</a>
                                </h5>
                            </span>
                            <span class="info-box-number">
                                <h4> <?php echo $data['countNotes']; ?></h4>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-4 col-md-6 col-10 mx-auto">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-tags" aria-hidden="true"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                <h5>No of
                                    Categories</h5>
                            </span>
                            <span class="info-box-number">
                                <h4> <strong> <?php echo $data['countCats']; ?> </strong></h4>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-4 col-md-6 col-10 mx-auto">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fa fa-user" aria-hidden="true"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                <h5> No of Users</h5>
                            </span>
                            <span class="info-box-number">
                                <h4> <?php echo $data['countUsers']; ?></h4>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
        </div>
    </section>
    <h4 class="mb-2 mt-4">Statistics</h4>
    <div class="row">
        <!-- AREA CHART -->
        <div class="col-md-6 notes-count">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Monthly Notes Comparison:</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- DONUT CHART -->
        <div class="col-md-6 categories-count">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Categories:</h3>
                </div>
                <div class="card-body">
                    <canvas id="donutChart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <h4 class="mb-2 mt-4">Recent Notes:</h4>
    <div class="row row-eq-height">

        <?php foreach ($data['recentNotes'] as $note) { ?>
        <div class="col-md-6">
            <!-- Primary tile -->
            <div class="card dashboard-card">
                <div class="card-header p-3">
                    <div>
                        <h6 class="nav-item d-inline">
                            <a class="badge badge-warning"
                                href="<?php echo URL ?>/notes/<?php echo $note->category; ?>">
                                <?php echo $note->category; ?> </a>
                        </h6>
                        <span class="float-right emoji position-relative">
                            <a href="#" class=" text-sm mr-2"><i class="fa fa-share mr-1"></i></a>
                            <p class="plus-one-text position-absolute d-inline">+1</p>
                            <p class="emoji-icon d-inline">&#128522; </p>
                        </span>
                    </div>
                    <h5 class="nav-item overflow-hidden">
                        <a href="/" class="text-truncate"> <?php echo $note->title; ?></a>
                    </h5>

                </div>
                <div class="card-body overflow-hidden">
                    <p class="badge badge-primary text-white">Latest:</p>
                    <p class="badge badge-danger text-white"> <?php echo $note->created_at; ?></p>
                    <div class="overflow-hidden">
                        <p class=" h-25">
                            <?php echo html_entity_decode($note->content); ?>
                        </p>
                    </div>
                </div><!-- /.box-body -->
                <div class="card-footer">
                    <p>
                        <a href="<?php echo URL . '/notes/edit/' . $note->id; ?>" class="btn text-white mr-2 <?php
                                                                                                                    echo $role !== 'admin' ? 'btn-secondary' : 'btn-info';
                                                                                                                    ?>"
                            style="<?php
                                                                                                                                if ($role !== 'admin') {
                                                                                                                                    echo 'pointer-events:none;';
                                                                                                                                }
                                                                                                                                ?>">
                            Edit</a>
                        <span class="float-right">
                            <a href="<?php echo URL . '/notes/note/' . $note->id; ?>"
                                class="btn btn-primary text-white">
                                Read More
                            </a>
                        </span>
                    </p>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
        <?php }; ?>

    </div>

</div>
</div>
<?php
require PRIVATE_PATH . '/views/inc/footer.php'; ?>