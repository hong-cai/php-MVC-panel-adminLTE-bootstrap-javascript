<?php
class ProfileModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPagesNames()
    {
        $this->db->query('SELECT section_name FROM `profile_pages` ORDER BY section_id ASC');
        return $result = $this->db->resultSet();
    }

    public function getAboutContents($position)
    {
        $this->db->query("SELECT DISTINCT `content_title`,`content_detail`  FROM `page_content` WHERE section_id IN
        (SELECT section_id FROM `profile_pages` WHERE section_name = 'ABOUT')AND `content_position`=:position");
        $this->db->bind(':position', $position);
        return $result = $this->db->resultSet();
    }

    public function getContacts()
    {
        $this->db->query("SELECT `content_title`,`content_detail` FROM `page_content`WHERE section_id IN
        (SELECT section_id FROM `profile_pages` WHERE `section_name` = 'CONTACTS') AND `content_position`=1");
        return $result = $this->db->resultSet();
    }

    public function getWorks($content_position)
    {
        $this->db->query("SELECT `content_position`, `content_detail`,`content_description`,`content_title` FROM `page_content`WHERE section_id IN
        (SELECT section_id FROM `profile_pages` WHERE `section_name` = 'EXPERIENCE') AND `content_position`=:content_position  ORDER BY `content_position` ASC");
        $this->db->bind(':content_position', $content_position);
        return $result = $this->db->resultSet();
    }

    public function getWorksLevel()
    {
        $this->db->query("SELECT `content_detail` FROM `page_content` WHERE `section_id` IN
        (SELECT section_id FROM `profile_pages` WHERE `section_name` = 'EXPERIENCE') AND `content_description`='level' ORDER BY `content_position` ASC");
        return $result = $this->db->resultSet();
    }

    public function getSkills()
    {
        $this->db->query("SELECT `content_position`, `content_detail`,`content_description`,`content_title` FROM `page_content` WHERE `section_id` IN (SELECT `section_id` FROM `profile_pages` WHERE `section_name` = 'SKILLS') ORDER BY `content_position` ASC");
        return $result = $this->db->resultSet();
    }


    public function getLevelContent($contentId){
        $this->db->query("SELECT content_detail FROM page_content WHERE section_id=2 AND content_position=:contentId and content_description='Description' LIMIT 1;");
        $this->db->bind(':contentId', $contentId);
        return $result = $this->db->resultSingle();
    }

    public function getTitleIntros($id)
    {
        $this->db->query("SELECT `section_title`,`section_description` FROM `profile_pages` WHERE `section_id`=:id");
        $this->db->bind(':id', $id);
        return $result = $this->db->resultSet();
    }



}
