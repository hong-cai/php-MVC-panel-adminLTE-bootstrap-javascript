<?php
class Notes extends Controller
{
    public function __construct()
    {
        $this->notesModel = $this->model('NotesModel');
    }

    public function index()
    {
        $notes = $this->notesModel->getNotes();
        $categories = $this->notesModel->getCategories();
        // $notes="O.S.T.R &amp;quot;Track #12&amp;quot;";
        // print_r($categories);
        $data = [
            'title' => 'All notes',
            'notes' => $notes,
            'categories' => $categories,

        ];
        if ($_SESSION['user_id']) {
            $this->view('notes/index', $data);
        } else {
            redirect('users/login');
        }
    }


    //Error page when user typed random url
    public function error()
    {
        $data = [
            'page_title' => 'Error',
            'error_msg' => 'Note can not be found'
        ];
        $this->view('notes/error', $data);
    }

    //get all categories for Bar Chart display
    public function categories()
    {
        $catsArray = [];
        $countCat = [];
        $lastMonCounts = [];
        $currentMonCounts = [];
        $countCatNew = [];
        $currentMonth = date('F');
        $lastMonth = Date("F", strtotime("first day of last month"));
        // die(Date("F", strtotime("first day of next month")));
        $categories = $this->notesModel->getCategories();

        foreach ($categories as $key) {
            array_push($catsArray, $key->category);
            $lastMonResult = json_decode(json_encode($this->notesModel->getMonthlyCounts($key->category, $lastMonth)), true);
            $curMonResult = json_decode(json_encode($this->notesModel->getMonthlyCounts($key->category, $currentMonth)), true);
            array_push($countCat, $this->notesModel->getCategoryCount($key->category));
            array_push($lastMonCounts, $lastMonResult['monthly_counts']);
            array_push($currentMonCounts, $curMonResult['monthly_counts']);
        };
        foreach ($countCat as $key) {
            array_push($countCatNew, $key->no_of_notes);
        }
        function strToNum($value)
        {
            return empty($value) ? 0 : intval($value);
        }
        $lastCountsNew = array_map('strToNum', $lastMonCounts);
        $curCountsNew = array_map('strToNum', $currentMonCounts);

        $data = [
            'categories' => $catsArray,
            'countCat' => $countCatNew,
            'lastMonCounts' => $lastCountsNew,
            'currentMonCounts' => $curCountsNew,
        ];
        // die(print_r($data['categories'][0]->category));
        echo json_encode($data);
    }


    public function note($id = "")
    {
        if (isset($id)) {
            $note = $this->notesModel->getNoteById($id);
            $data = [
                'title' => $note->title,
                'id' => $id,
                'body' => $note->content,
                'category' => $note->category,
                'created_at' => $note->created_at,
            ];
            // die(print_r($data));
            $this->view('notes/note', $data);
        } elseif ($id === null) {
            redirect('notes');
        }
    }

    //get a single note for display
    public function getSingleNote($id)
    {
        if (isset($id)) {
            $note = $this->notesModel->getNoteById($id);
            $data = [
                'title' => html_entity_decode($note->title),
                'id' => $id,
                'body' => html_entity_decode($note->content),
                'category' => html_entity_decode($note->category),
                'created_at' => html_entity_decode($note->created_at),
            ];
            echo json_encode($data);
        } elseif ($id === null) {
            echo $data = [];
        }
    }
    //add a new note
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // die(print_r(htmlspecialchars($_POST['body'])));
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $cats = $this->notesModel->getCategories();
            $data = [
                'title' => htmlspecialchars(trim($_POST['title'])),
                'body' => htmlspecialchars(trim($_POST['body'])),
                'category' => isset($_POST['category']) ? htmlspecialchars(trim($_POST['category'])) : 'Not Specified',
                'title_err' => '',
                'body_err' => '',
                'categories' => $cats,
            ];
            if (empty($_POST['title'])) {
                $data['title_err'] = 'The title should not be empty';
            }
            if (empty($_POST['body'])) {
                $data['body_err'] = 'Fill the note content';
            }

            if (empty($data['title_err']) && empty($data['body_err'])) {
                // die(print_r($data['body']));
                //Store into database
                if ($this->notesModel->saveNote($data)) {
                    flash('post_message', 'Note Added successfully');
                    // die($data);
                    $this->view('notes/add', $data);
                } else {
                    echo 'something wrong';
                };
            }
            //Load view with errors
            $this->view('notes/add', $data);
        } else {
            $cats = $this->notesModel->getCategories();
            $data = [
                'title' => '',
                'body' => '',
                'categories' => $cats,

            ];
            $this->view('notes/add', $data);
        }
    }

    //edit and update a note
    public function edit($id)
    {
        // die($_SERVER['REQUEST_METHOD']);
        if (isset($id)) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'title' => htmlspecialchars(trim($_POST['title'])),
                    'body' => htmlspecialchars(trim($_POST['body'])),
                    'category' => htmlspecialchars(trim($_POST['category'])),
                    'title_err' => '',
                    'body_err' => '',
                ];
                if (empty($_POST['title'])) {
                    $data['title_err'] = 'The title should not be empty';
                }
                if (empty($_POST['body'])) {
                    $data['body_err'] = 'Fill the note body';
                }

                if (empty($data['title_err']) && empty($data['body_err'])) {
                    //Store into database
                    if ($this->notesModel->updateNote($data)) {
                        flash('post_message', 'Update successfully');
                        redirect('notes/index');
                    }
                } else {
                    //Load view with errors
                    $this->view('notes/edit', $data);
                }
            } else {
                $note = $this->notesModel->getNoteById($id);
                $cats = $this->notesModel->getCategories();
                //Check if admin/default
                // if ($note->id != $_SESSION['user_id']) {
                //     redirect('notes/index');
                // }
                $data = [
                    'id' => $id,
                    'title' => $note->title,
                    'body' => $note->content,
                    'category' => $note->category,
                    'categories' => $cats,
                ];
                $this->view('notes/edit', $data);
            }
        } else {
            redirect('notes');
        }
    }

    //delete a note by clicking delete button
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->notesModel->deleteNote($id)) {
                flash('post_message', 'post deleted');
                redirect('notes/index');
            } else {
                die('something wrong');
            };
        } else {
            die('something wrong');
            redirect('notes');
        }
    }

    //Use the keyword to search database for notes with the keyword
    public function search($keywords = '')
    {
        if (!empty($_POST['q'])) {
            $keywords = filter_var($_POST['q'], FILTER_SANITIZE_STRING);
        }
        $result = $this->notesModel->filterNotes($keywords);
        echo json_encode($result);
    }
};