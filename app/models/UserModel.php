<?php
class UserModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //Normal user create account on Register Page
    public function createUser($data)
    {
        return $this->db->insert('users', $data);
    }

    //Delete user by ID
    public function deleteUser($id)
    {
       if($this->db->delete('users', $id)){
        return $result = array(
            'status' => 'yes',
            'msg' => 'data deleted',
        );
       } else {
        return $result = array(
            'status' => 'no',
            'msg' => 'something wrong when deleting',
        );
    };
    }

    //Login:find a user by Email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT email FROM users WHERE email=:email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        $rowCount = $this->db->rowCount();
        // die(var_dump($rowCount));
        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Login user with Email and password
    public function loginUser($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email', $email);
        $row = $this->db->resultSingle();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }

    }

    //Get all users' infomation
    public function getUsers()
    {
        $this->db->query('SELECT * FROM users');
        return $result = $this->db->resultSet();
    }

    // Get one user's data
    public function getUserInfo($id)
    {
        $this->db->query('SELECT * FROM users WHERE id=:id');
        $this->db->bind(':id', $id);
        if ($this->db->resultSingle()) {
            return $row = $this->db->resultSingle();
        } else {
            echo 'something wrong';
        }
    }

    //EditUsers Page: First Table: Update/Edit a user's data
    public function updateUser($data)
    {
        $this->db->query('UPDATE `users` SET `email` = :email, `password` = :password,`name`=:name,`status`=:status,`updated_at`= NOW() WHERE `id`=:id');
        $this->db->bind(':id', htmlspecialchars($data['user_id']));
        $this->db->bind(':email', htmlspecialchars($data['user_email']));
        $this->db->bind(':name', htmlspecialchars($data['user_name']));
        $this->db->bind(':status', htmlspecialchars($data['user_role']?$data['user_role']:'default'));
        $this->db->bind(':password', password_hash($data['user_password'], PASSWORD_DEFAULT));
        return $this->db->execute();
    }
    
    //EditUsers Page: Second Table: Update/Edit a user's data
    public function editUser($data)
    {
        $sth = $this->db->query('UPDATE `users` SET `email` = :email, `password` =:password,`name`=:name ,`status`=:status ,`updated_at`= NOW() WHERE `id`=:id');
        $this->db->bind(':id', htmlspecialchars($data['user_id']));
        $this->db->bind(':email', htmlspecialchars($data['user_email']));
        $this->db->bind(':name', htmlspecialchars($data['user_name']));
        $this->db->bind(':status', htmlspecialchars($data['user_role']?$data['user_role']:'default'));
        $this->db->bind(':password', password_hash($data['user_password'], PASSWORD_DEFAULT));
        $test=$this->db->execute();
        if ($test) {
            return $result = array(
                'status' => 'yes',
                'msg' => 'data updated',
                'data' => $data,
            );
        } else {
            return $result = array(
                'status' => 'no',
                'msg' => 'something wrong when processing',
                'data' => 'no data fetched',
            );
        };
        // header('location:' . URL . 'users');
    }
    
    public function getUserRole()
    {
        $this->db->query('UPDATE `users` SET `email` = :email, `password` = :password,`name`=:name,`updated_at`= NOW() WHERE `id`=:id');
    }
}
;