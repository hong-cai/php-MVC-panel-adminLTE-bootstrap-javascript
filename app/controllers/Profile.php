<?php
class Profile extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->notesModel = $this->model('NotesModel');
        $this->profileModel = $this->model('ProfileModel');
    }

    public function index()
    {
        $page_names = $this->profileModel->getPagesNames();
        $skills = $this->profileModel->getSkills();
        $about_contents = $this->profileModel->getAboutContents(1);
        $contacts = $this->profileModel->getAboutContents(2);
        $notes = $this->notesModel->getNotesList();
        // $role = $this->userModel->getUserRole();
        $works = array();
        $title_intros = array();
        for ($i = 0; $i < 6; $i++) {
            array_push($works, $this->profileModel->getWorks($i + 1));
        }
        for ($i = 0; $i < 3; $i++) {
            array_push($title_intros, $this->profileModel->getTitleIntros($i + 1));
        }
        $isLoggedIn = isset($_SESSION['user_id']) && $_SESSION['user_role'] === "admin";
        $data = [
            'page_names' => $page_names,
            'about_contents' => $about_contents,
            'contacts' => $contacts,
            'works' => $works,
            'skills' => $skills,
            'title_intros' => $title_intros,
            'notes' => $notes,
            'user_name' => 'Sophie',
            'login_state' => $isLoggedIn,
        ];
        // die(print_r($data['skills'][24]->content_detail));
        $this->view('profile/index', $data);
    }

    public function error()
    {
        $data = [
            'error_msg' => 'something wrong when redirecting to default controller',
            'page_title' => 'Oops..'
        ];
        $this->view('profile/error', $data);
    }

    public function getStarsLevel()
    {
        $data = $this->profileModel->getWorksLevel();
        echo json_encode($data);
    }


    public function getSkillsInfo()
    {
        $data = $this->profileModel->getSkills();
        // echo json_encode($data);

        //Re-structure $data to the necessary array
        $data_subjects = array();
        $data_details = array();
        $data_keys = array();
        foreach ($data as $key => $value) {
            array_push($data_subjects, $value->content_title);
            array_push($data_details, $value->content_detail);
            array_push($data_keys, $value->content_description);
        }

        //Combine two arrays into one array as $key=>$value
        function combine($key, $val)
        {
            return array($key => $val);
        }
        $arrResult = array_map('combine', $data_keys, $data_details);
        $chunckedArray = array_chunk($arrResult, 3);
        $subjectsArray = array_values(array_unique($data_subjects));

        //Push the skill titles array in the main array, flattening the data array
        $newSubjects = array();
        $key = 'Title';
        for ($i = 0; $i < count($subjectsArray); $i++) {
            array_push($newSubjects, array($key => $subjectsArray[$i]));
            array_push($chunckedArray[$i], $newSubjects[$i]);
        }
        echo json_encode($chunckedArray);
    }


    public function getLevelDetails($contentId)
    {
        $data = $this->profileModel->getLevelContent($contentId);
        die($data);
    }


    public function form()
    {
        //alert message variables
        $msg = "";
        if (filter_has_var(INPUT_POST, 'email')) {
            $name = $_POST['full_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];
            //It's unusual this doesn't included in $_POST
            // $submit = $_POST['submit'];
            // print_r($_POST);

            //Check if fields empty
            if (!empty($email) && !empty($name) && !empty($message)) {
                //Test if Email valid:
                if (filter_var($email, FILTER_VALIDATE_EMAIL === false)) {
                    echo $msg = "Please use a valid email";
                } else {
                    //set mail sending configs
                    $to_email = "hongcai.nelson@gmail.com";
                    $subject = 'Contact Form from ' . $name;
                    $body = "From: $name\n E-Mail: $email\n Message:\n $message";
                    $headers = "MIME-Version:1.0 \r\n" .
                        $headers = "Content-Type:text/html;charset=UTF-8 \r\n" .
                        $headers = "From:" . $name . "<" . $email . ">" . "\r\n Reply-To:" . $email . "\r\n";
                    if (mail($to_email, $subject, $body, $headers)) {
                        $msg = "Success! I will be in touch soon.";
                    } else {
                        $msg = "Sorry but the mail was not sent,please try again";
                    }
                }
            } else {
                //fail
                $msg = 'Please fill in all required fields';
            }
            //         $email_from = 'Demo Contact Form'; 
            //         $email_subject="form submission";
            //         $email_body="From: $name\n E-Mail: $email\n Message:\n $message";
            //         $to_email = 'hongcai.nelson@gmail.com'; 
            //         $subject = 'Message from Contact Demo ';

            //         

            //         $secretKey="6Ldz18MZAAAAABB65f-xR_Yvo7ZGJ-oJtaW0TcvN";
            //         $responseKey=$_POST['g-recaptcha-response'];
            //         $userIP=$_SERVER['REMOTE_ADDR'];
            //         $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

            //         $response=file_get_contents($url);
            //         $response=json_decode($response);


            //         if($response->success){
            //             mail($to,$message,$body,$headers);
            //             $result->response= "message sent successfully";
            //         }else{
            //             $result->response= "<span>Invalid Captcha,Please try again</span>";
            //         }

            //         // Check if email has been entered and is valid
            //         if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            //             $errEmail = 'Please enter a valid email address';
            //         }
            // // If there are no errors, send the email
            // if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
            //     if($response->success){
            //         $feedback=mail($to, $subject, $body, $from);
            //     if ($feedback) {
            //         $result->tip='<div class="form-group wrap-inputs validate-input" id="FormConfirmation"><div style="color: white; background-color: #FF3B30;width: 325px;border-radius: 0.25em;padding: .3em;margin: 0 auto;">Thank You! I will be in touch</div></div>';
            //     } else {
            //         $result->tip='<div class="form-group wrap-inputs validate-input" id="FormConfirmation"><div style="color: white; background-color: #FF3B30;width: 325px;border-radius: 0.25em;padding: .3em;margin: 0 auto;">Sorry there was an error sending your message. Please try again later.</div></div>';
            //     }}
            //     else{
            //         $result->tip='<div class="form-group wrap-inputs validate-input" id="FormConfirmation"><div style="color: white; background-color: #FF3B30;width: 325px;border-radius: 0.25em;padding: .3em;margin: 0 auto;">Invalid Captcha,please try again.</div></div>';
            //     }
            // };

        } else {
            echo $msg = "did not get through";
        }
        // else{
        //     $result->tip='<div class="form-group wrap-inputs validate-input" id="FormConfirmation"><div style="color: white; background-color: #FF3B30;width: 325px;border-radius: 0.25em;padding: .3em;margin: 0 auto;">Invalid email please try again</div></div>';
        // }
        // return json_encode($result);
    }
}