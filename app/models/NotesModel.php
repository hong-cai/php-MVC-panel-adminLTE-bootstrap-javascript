 <?php
    class NotesModel
    {
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }

        public function getNotes()
        {
            $this->db->query('SELECT * FROM `notes` ORDER BY created_at DESC');
            return $result = $this->db->resultSet();
        }

        public function getNoteById($id)
        {
            $this->db->query('SELECT * FROM `notes` WHERE id=:id');
            $this->db->bind(':id', $id);
            return $result = $this->db->resultSingle();
        }

        public function getCategories()
        {
            $this->db->query("SELECT DISTINCT category FROM `notes`WHERE category IS NOT NULL
        AND TRIM(category) <> ''");

            $result = $this->db->resultSet();
            return $result;
        }

        public function sortedByCat()
        {
            $this->db->query('SELECT * FROM notes');
        }

        public function updateNote($data)
        {
            $this->db->query('UPDATE `notes` SET `category` = :category, `content` = :content, `title` = :title,`updated_at`= NOW() WHERE `id`=:id');
            //Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':content', $data['body']);
            $this->db->bind(':title', $data['title']);

            //Execute query
            return $this->db->execute() ? true : false;
        }

        public function saveNote($data)
        {
            $this->db->query('INSERT INTO notes(category,content,title) VALUES (:category,:content,:title)');
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':content', $data['body']);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteNote($id)
        {
            $this->db->query('DELETE FROM `notes` WHERE id = :id');
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function countNum()
        {
            $this->db->query('SELECT COUNT(id) FROM `notes`;');
            return $result = get_object_vars($this->db->resultSingle());
        }

        public function countCat()
        {
            $this->db->query('SELECT COUNT(distinct category) FROM `notes`;');
            return $result = get_object_vars($this->db->resultSingle());
        }

        public function countUsers()
        {
            $this->db->query('SELECT COUNT(id) FROM `users`;');
            return $result = get_object_vars($this->db->resultSingle());
        }
        public function getNotesList()
        {
            $this->db->query("SELECT `id`, `category`, `content`, `title`, `created_at` FROM `notes`ORDER BY  `created_at` DESC");
            $result = $this->db->resultSet();
            return $result;
        }
        public function getCategoryCount($cat)
        {
            $this->db->query("SELECT COUNT(id) AS `no_of_notes` FROM `notes` WHERE `category`=:cat");
            $this->db->bind(':cat', $cat);
            return $result = $this->db->resultSingle();
        }
        public function getMonthlyCounts($cat, $month)
        {
            $this->db->query("SELECT count(DATE_FORMAT( created_at, '%M'))AS monthly_counts FROM notes WHERE category=:cat AND DATE_FORMAT( created_at, '%M')=:month GROUP BY DATE_FORMAT( created_at, '%M')");
            $this->db->bind(':cat', $cat);
            $this->db->bind(':month', $month);
            return $this->db->resultSingle();
        }

        public function getRecentNotes()
        {
            $this->db->query("SELECT id,category,MAX(created_at) AS created_at,content,title FROM notes GROUP BY category ORDER BY MAX(created_at) DESC");
            $result = $this->db->resultSet();
            return $result;
        }

        public function filterNotes($string)
        {
            $this->db->query("SELECT * FROM notes
        WHERE MATCH(title, content, category) AGAINST ( :string IN BOOLEAN MODE)");
            $this->db->bind(':string', $string);
            $result = $this->db->resultSet();
            return $result;
        }
    }