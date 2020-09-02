<?php
require PRIVATE_PATH . '/views/inc/front-header.php'; ?>

<body>
    <!-- - Prevent CSS Transition Before Fully Loading - -->
    <div class="preloader">
        <div class="preloading-container">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>


    <div class="left-arrow">
        <span> <i class="fa fa-arrow-left"></i> </span>
    </div>

    <div class="main">
        <!-- - Navs and Responsive Menu - -->
        <div class="cards-nav" id='cards-nav'>
            <div class="nav-mobile">
                <div class="page-logo">
                    <span>
                        <h3> <?php echo $data['user_name']; ?> </h3>
                    </span>
                </div>
                <div class="nav-btn">
                    <span id="menu-bars"> <i></i> </span>
                </div>
            </div>
            <div class="nav-menu">
                <?php foreach ($data['page_names'] as $page_name) {; ?>
                <div class="nav-wrapper nav-<?php echo strtolower($page_name->section_name) ?> ">
                    <a href="#<?php echo strtolower($page_name->section_name) ?>">
                        <h4> <?php echo $page_name->section_name ?> </h4>
                    </a>
                </div>
                <?php }; ?>
            </div>
        </div>
        <div class="cards">
            <div class="cards-track">
                <div class="card">
                    <div class="wrapper card-notes">
                        <div class="card-details">
                            <h1>
                                <div class="title-text"> <?php echo $data['title_intros'][0][0]->section_title; ?>
                                </div>
                            </h1>
                        </div>
                        <div class="card-intro">
                            <h4>
                                <?php echo $data['title_intros'][0][0]->section_description; ?>
                            </h4>
                            <div class="sort-notes">
                                <form action="notes/sortNotes" id="sort-notes">

                                </form>
                            </div>
                        </div>
                        <div class="content-wrapper">
                            <div class="content-range content-notes">
                                <ul class="note-sample">


                                    <?php if (!empty($data['notes'])) {
                                        foreach ($data['notes'] as $note) {; ?>
                                    <li class="note" data-id=" <?php echo $note->id; ?> ">
                                        <div class="note-title">
                                            <h4 onclick="document.querySelector('.modal-note').style.display='block'"
                                                style="width:auto;"> <strong> <?php echo $note->title; ?> </strong></h4>
                                            <div class="note-category">
                                                <span class="note-tag">
                                                    <h5><?php echo $note->category; ?></h5>
                                                </span>
                                                <span class="note-tag">
                                                    <h5><?php echo $note->created_at; ?></h5>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="note-body" style="width:auto;">
                                            <div>
                                                <?php echo html_entity_decode($note->content); ?>
                                            </div>
                                        </div>
                                        <div class="note-footer">
                                            <button data-id="<?php echo $note->id; ?>">Read
                                                More</button>
                                            <button
                                                onclick="document.querySelector('.modal-note').style.display='block'"
                                                class="<?php echo $data['login_state'] == null ? "disable-btn" : ""; ?>">Edit</button>
                                            <button
                                                onclick="document.querySelector('.modal-delete').style.display='block'"
                                                class="<?php echo $data['login_state'] == null ? "disable-btn" : ""; ?>">Delete</button>
                                        </div>
                                    </li>
                                    <?php }
                                    }; ?>
                                    <div class="modal-login">
                                        <div class="login-form animate">
                                            <div class="card-details">
                                                <h3>
                                                    <div class="title-text">Login To Read More?</div>
                                                </h3>
                                            </div>
                                            <div class="form-body">
                                                <form action="<?php echo URL; ?>/users/login" method="post"
                                                    class="modal-content login-validate">

                                                    <div class="form-group wrap-inputs validate-input"
                                                        data-validate="Valid email is required">
                                                        <span class="required label-inputs">Email:</span>
                                                        <input type="email" class="form-control input100" name="email"
                                                            placeholder="john-doe@gmail.com" required />
                                                    </div>
                                                    <div class="form-group wrap-inputs validate-input"
                                                        data-validate="Password is required">
                                                        <span class="required label-inputs">Password:</span>
                                                        <input type="password" class="form-control input100"
                                                            id="password" name="password" placeholder="******"
                                                            required />
                                                    </div>
                                                    <div class="form-footer">
                                                        <div class="form-action-group">
                                                            <div class="container">
                                                                <a href="<?php echo URL; ?>/users/register">Create
                                                                    an account</a>
                                                                <button class="submit-button" type="submit"
                                                                    name="submit">Login</button>
                                                            </div>
                                                            <!-- <span class="psw">Forget <a href="#">password?</a></span> -->
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal-note">
                                        <!-- <div class="note note-display animate">
                                            <div class="note-title">
                                                <h4> <strong> How to prevent button click event triggering
                                                        capturing:</strong></strong></h4>
                                                <div class="note-category">
                                                    <span class="note-tag">
                                                        <h5>PHP</h5>
                                                    </span>
                                                    <span class="note-tag">
                                                        <h5>javascript</h5>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="note-body">
                                                <p>
                                                    This is the php note table content
                                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                    Dolorum
                                                    animi
                                                    quo,
                                                    minima commodi explicabo inventore. Quos illum atque neque
                                                    impedit
                                                    praesentium, id dolorem minima saepe, temporibus nobis cum
                                                    cumque
                                                    commodi.
                                                    minima commodi explicabo inventore. Quos illum atque neque
                                                    impedit
                                                    praesentium, id dolorem minima saepe, temporibus nobis cum
                                                    cumque
                                                    commodi.
                                                </p>
                                            </div>
                                            <div class="note-footer">

                                                <button
                                                    onclick="document.querySelector('.modal-note').style.display='none'"
                                                    style="width:auto;">ok</button>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="modal-delete">
                                        <div class="delete-window animate">
                                            <div class="delete-warning">
                                                <h3>
                                                    <div class="title-text">This note will be deleted?</div>
                                                </h3>
                                            </div>
                                            <div class="delete-confirm">
                                                <span>
                                                    <button class="confirm-y"> &#x2714; </button></span>
                                                <span> <button class="confirm-n">X </button></span>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card skills">
                    <div class="wrapper card-skills">
                        <div class="card-details">
                            <h1>
                                <div class="title-text"> <?php echo $data['title_intros'][1][0]->section_title; ?>
                                </div>
                            </h1>
                        </div>
                        <div class="card-intro">
                            <h4>
                                <?php echo $data['title_intros'][1][0]->section_description; ?>
                            </h4>
                        </div>
                        <div class="content-wrapper">
                            <div class="modal-skill">
                            </div>
                            <div class="content-range content-skills">
                                <div class="progress-bars">
                                </div>


                                <!-- <table border='1'>
                                <tr>
                                    <td align=center> <b>title</b></td>
                                    <td align=center><b>detail</b></td>
                                    <td align=center><b>position</b></td>
                                    <td align=center><b>description</b></td>
                                </tr>

                                <?php
                                // if (!empty($data['skills'])) {
                                //     foreach ($data['skills'] as $skill_info): 
                                ?>

//                                 <?php
                                    // echo "<tr>";
                                    //     echo "<td align=center>" . $skill_info->content_title . "</td>";
                                    //     echo "<td align=center>" . $skill_info->content_detail. "</td>";
                                    //     echo "<td align=center>" . $skill_info->content_position . "</td>";
                                    //     echo "<td align=center>" . $skill_info->content_description . "</td>";
                                    //     echo "</tr>";
                                    ?>
                                <?php //endforeach;}
                                ; ?>
                            </table> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card experience">
                    <div class="wrapper card-experience">
                        <div class="card-details">
                            <h1>
                                <div class="title-text"> <?php echo $data['title_intros'][2][0]->section_title; ?></div>
                            </h1>
                        </div>
                        <div class="card-intro">
                            <h4>
                                <?php echo $data['title_intros'][2][0]->section_description; ?>
                            </h4>
                        </div>
                        <div class="content-wrapper">
                            <div class="content-range content-experience">
                                <div class="frame-wrapper">
                                    <?php
                                    if (!empty($data['works'])) {
                                        foreach ($data['works'] as $work_info) : ?>

                                    <div class="website-frame">
                                        <div class="website-screenshot">
                                            <div class="website-img"
                                                onclick="document.querySelector('.modal-img').style.display = 'block';">
                                                <a href=" <?php echo $work_info[4]->content_detail; ?>"
                                                    onclick="event.preventDefault();">
                                                    <img src=" <?php echo $work_info[4]->content_detail; ?> "
                                                        alt=" <?php echo $work_info[0]->content_title; ?> "></a>
                                            </div>
                                            <div class="website-text">
                                                <div>
                                                    <a href="<?php echo $work_info[3]->content_detail; ?>">
                                                        <h3> <?php echo $work_info[0]->content_title; ?></h3>
                                                    </a>
                                                    <div class='project-level'>
                                                        <span> <strong>Difficulty:</strong></span>
                                                        <div class="stars-track">
                                                            <div class="progress">
                                                                <div class="star"><i class="fa fa-star"></i></div>
                                                                <div class="star"><i class="fa fa-star"></i></div>
                                                                <div class="star"><i class="fa fa-star"></i></div>
                                                                <div class="star"><i class="fa fa-star"></i></div>
                                                                <div class="star"><i class="fa fa-star"></i></div>
                                                            </div>
                                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                                        </div>
                                                    </div>
                                                    <span>
                                                        <strong>Time:&nbsp</strong><?php echo $work_info[2]->content_detail; ?>
                                                    </span>
                                                    <div><?php echo $work_info[0]->content_detail; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;
                                    }; ?>
                                </div>








                                <!-- <table border='1'>
                                    <tr>
                                        <td align=center> <b>title</b></td>
                                        <td align=center><b>detail</b></td>
                                        <td align=center><b>position</b></td>
                                        <td align=center><b>description</b></td>
                                    </tr> -->

                                <?php
                                // if (!empty($data['works'])) {
                                //     foreach ($data['works'] as $work_info): 
                                ?>

                                <?php
                                // echo "<tr>";
                                //     echo "<td align=center>" . $work_info[0]->content_title . "</td>";
                                //     echo "<td align=center>" . $work_info[0]->content_detail . "</td>";
                                //     echo "<td align=center>" . $work_info[0]->content_position . "</td>";
                                //     echo "<td align=center>" . $work_info[0]->content_description . "</td>";
                                //     echo "</tr>";
                                //     echo "<tr>";
                                //     echo "<td align=center>" . $work_info[1]->content_title . "</td>";
                                //     echo "<td align=center>" . $work_info[1]->content_detail . "</td>";
                                //     echo "<td align=center>" . $work_info[1]->content_position . "</td>";
                                //     echo "<td align=center>" . $work_info[1]->content_description . "</td>";
                                //     echo "</tr>";
                                //     echo "<tr>";
                                //     echo "<td align=center>" . $work_info[2]->content_title . "</td>";
                                //     echo "<td align=center>" . $work_info[2]->content_detail . "</td>";
                                //     echo "<td align=center>" . $work_info[2]->content_position . "</td>";
                                //     echo "<td align=center>" . $work_info[2]->content_description . "</td>";
                                //     echo "</tr>";
                                //     echo "<tr>";
                                //     echo "<td align=center>" . $work_info[3]->content_title . "</td>";
                                //     echo "<td align=center>" . $work_info[3]->content_detail . "</td>";
                                //     echo "<td align=center>" . $work_info[3]->content_position . "</td>";
                                //     echo "<td align=center>" . $work_info[3]->content_description . "</td>";
                                //     echo "</tr>";
                                //     echo "<tr>";
                                //     echo "<td align=center>" . $work_info[4]->content_title . "</td>";
                                //     echo "<td align=center>" . $work_info[4]->content_detail . "</td>";
                                //     echo "<td align=center>" . $work_info[4]->content_position . "</td>";
                                //     echo "<td align=center>" . $work_info[4]->content_description . "</td>";
                                //     echo "</tr>";
                                ?>
                                <?php // endforeach;}
                                ; ?>
                                </table>






                            </div>
                        </div>
                    </div>
                </div>




                <div class="card about current-card">
                    <div class="wrapper card-about">
                        <div class="card-id">
                            <div class="avatar">
                                <img src="./css/img/avatar-bg-sm.gif" alt="my-avatar" srcset="">
                            </div>

                            <div class="personal-info">
                                <div class="personal-brief">
                                    <p>Hong Cai &nbsp(Sophie)</p>
                                    <p>Website Maker. Doer.</p>
                                    <p>To be a good developer.</p>
                                    <div class="stars-rating">
                                        <div class="stars-track">
                                            <div class="progress">
                                                <div class="star"><i class="fa fa-star"></i></div>
                                                <div class="star"><i class="fa fa-star"></i></div>
                                                <div class="star"><i class="fa fa-star"></i></div>
                                                <div class="star"><i class="fa fa-star"></i></div>
                                                <div class="star"><i class="fa fa-star"></i></div>
                                            </div>
                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="personal-contacts">
                                    <?php foreach ($data['contacts'] as $contact) {
                                        echo "<p> <i class='fa fa-" . $contact->content_title . "'>&nbsp</i> " . $contact->content_detail . "</p>";
                                    }; ?>
                                    <!-- <p> <i class="fa fa-map-marker">&nbsp</i> Wellington,New Zealand</p>
                                    <p> <i class="fa fa-phone">&nbsp</i> (022)4155875</p>
                                    <p> <i class="fa fa-home">&nbsp</i>
                                        <a href="https://sophie-nz.monster">https://sophie-nz.monster</a>
                                    </p>
                                    <p> <i class="fa fa-at">&nbsp</i> <a
                                            href="mailto:hongcai.nelson@gmail.com">hongcai.nelson@gmail.com</a></p>
                                    <p> <i class="fa fa-github">&nbsp</i>
                                        <a href="https://github.com/hong-cai">https://github.com/hong-cai</a></p> -->
                                </div>
                            </div>
                            <ul class="main-btns">
                                <?php
                                foreach ($data['about_contents'] as $about_content) {
                                    $title = $about_content->content_title;
                                    $detail = $about_content->content_detail;
                                    echo "<li>
    <button class='tag-btn'>
        <h4>" . $title . "</h4>
    </button>
    </li>";
                                }; ?>
                            </ul>
                        </div>

                        <div class="content-wrapper">
                            <div class="content-range content-about">

                                <?php
                                foreach ($data['about_contents'] as $about_content) {
                                    $title = $about_content->content_title;
                                    $detail = $about_content->content_detail;
                                    echo "<div class='tag-slide'><span><h3>" . $title . "</h3></span>";
                                    echo "<p>" . $detail . " </p>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card contact">
                    <div class="wrapper  card-contact">
                        <div class="content-wrapper">
                            <div class="content-range">
                                <div class="contact-info">
                                    <div class="card-details">
                                        <h3>
                                            <div class="title-text"> Hire Me. </div>
                                        </h3>
                                    </div>
                                    <div class="personal-contacts">
                                        <?php foreach ($data['contacts'] as $contact) {
                                            echo "<p> <i class='fa fa-" . $contact->content_title . "'>&nbsp</i> " . $contact->content_detail . "</p>";
                                        }; ?>

                                        <!-- <p> <i class="fa fa-map-marker">&nbsp</i> Wellington,New Zealand</p>
                                        <p> <i class="fa fa-phone">&nbsp</i> (022)4155875</p>
                                        <p> <i class="fa fa-home">&nbsp</i>
                                            <a href="https://sophie-nz.monster">https://sophie-nz.monster</a>
                                        </p>
                                        <p> <i class="fa fa-at">&nbsp</i> <a
                                                href="mailto:hongcai.nelson@gmail.com">hongcai.nelson@gmail.com</a>
                                        </p>
                                        <p> <i class="fa fa-github">&nbsp</i>
                                            <a href="https://github.com/hong-cai">https://github.com/hong-cai</a>
                                        </p> -->
                                    </div>
                                    <div id="map"></div>
                                </div>
                                <div class="social-media">
                                    <span> <a href="https://github.com/hong-cai"> <i
                                                class="fa fa-github fa-inverse"></i></a> </span>
                                    <span> <a href="https://codepen.io/Sophietsai/"> <i
                                                class="fa fa-codepen fa-inverse"></i></a> </span>
                                    <span> <a href="https://linkedin.com/in/hong-cai-ba4976142/">
                                            <i class="fa fa-linkedin fa-inverse"></i></a> </span>
                                    <span> <a href="https://twitter.com/sophie_hong_cai"><i
                                                class="fa fa-twitter fa-inverse"></i></a> </span>
                                </div>
                            </div>
                            <div class="content-range">
                                <div class="contact-form">
                                    <div class="card-details">
                                        <h3>
                                            <div class="title-text">Drop A Line.</div>
                                        </h3>
                                    </div>
                                    <div class="form-body">
                                        <form action="<?php echo URL . '/profile/form' ?>" method="POST"
                                            class="contacts-validate" id="contact-form">

                                            <div class="form-group wrap-inputs validate-input"
                                                data-validate="Name is required">
                                                <span class="required label-inputs">Name:</span>
                                                <input type="text" class="form-control input100" id="full_name"
                                                    value="<?php echo htmlspecialchars(isset($_POST['full_name']) ? $_POST['full_name'] : ''); ?>"
                                                    name="full_name" placeholder="John Doe" required />
                                            </div>

                                            <div class="form-group wrap-inputs validate-input"
                                                data-validate="Valid email is required">
                                                <span class="required label-inputs">Email:</span>
                                                <input type="email" class="form-control input100" id="email"
                                                    value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ''); ?>"
                                                    name="email" placeholder="john-doe@gmail.com" required />
                                                <?php if (!empty($errEmail)) {
                                                    echo "<p class='text-danger'>" . $errEmail . "</p>";
                                                } ?>
                                            </div>
                                            <div class="form-group wrap-inputs">
                                                <span class="required label-inputs">Phone:</span>
                                                <input type="text" class="form-control input100" id="phone" name="phone"
                                                    value="<?php echo htmlspecialchars(isset($_POST['phone']) ? $_POST['phone'] : ''); ?>"
                                                    placeholder="09-1234567" required />
                                            </div>

                                            <div class="form-group wrap-inputs validate-input"
                                                data-validate="Message is required">
                                                <span class="required label-inputs">Message:</span>
                                                <textarea type="text" class="form-control input100" id="message"
                                                    value="<?php echo htmlspecialchars(isset($_POST['message']) ? $_POST['message'] : ''); ?>"
                                                    name="message" placeholder="What can I do to help?"
                                                    required></textarea>
                                            </div>
                                            <div class="g-recaptcha"
                                                data-sitekey="6Ldz18MZAAAAAEH2HqfyT6P5QQBJkS0unzBrCs41"
                                                data-submit="...Sending" data-callback='onSubmit' data-action='submit'>
                                            </div>
                                            <div class="status" id='error-txt'>

                                            </div>
                                            <div class="form-action-group">
                                                <button class="submit-button" name="submit" type="submit"
                                                    id="contact-submit" value="send">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="right-arrow">
        <span> <i class="fa fa-arrow-right"></i> </span>
    </div>


    <?php
    require PRIVATE_PATH . '/views/inc/front-footer.php'; ?>