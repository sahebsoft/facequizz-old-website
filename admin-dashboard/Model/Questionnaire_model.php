<?php

class Questionnaire_Model extends AppModule {
    
    function __construct() {
        parent::__construct();
        $this->db = Database::$connection;
    }
    
    function query(){
        return $this->db->select("select s.section_id,s.section_title_a section_title,
            a.question_id,a.sub_question_id, concat(a.question_id,'_',a.sub_question_id) question_no ,a.question_title_a question_title,a.question_type,a.ng_show,a.ng_hide,
            b.option_id,b.option_title_a option_title,b.option_value
            from section s 
            left outer join question a  on s.section_id = a.section_id 
            left outer join question_option b ON  b.question_id = a.question_id and a.sub_question_id = 0
            order by s.section_id,a.question_id,sub_question_id,b.option_id");
        
        /*return $this->db->select("select * from (select s.section_id,s.section_title_a section_title,'' question_id,'' question_title,'' question_type,'' ng_show, '' ng_hide,'' option_id,'' option_title,'' option_value,'' label_id,'' label_title,'' label_type,'' label_ng_show,'' label_ng_hide from section  s
                                UNION
                                select a.section_id,'',a.question_id,a.question_title_a question_title,a.question_type,a.ng_show,a.ng_hide,'','','','','','','','' from question a
                                UNION 
                                select '','',b.question_id,'','','','',b.option_id,b.option_title_a option_title,b.option_value,'','','','','' from question_option b
                                UNION 
                                select '','',c.question_id,'','','','','','','',c.label_id,c.label_title_a label_title,c.label_type,c.label_ng_show,c.label_ng_hide 
                                from question_label c) x 
                                order by CAST(x.section_id AS INTEGER),CAST(x.question_id  AS INTEGER),CAST(x.option_id AS INTEGER),CAST(x.label_id  AS INTEGER)");*/
    }
    
    function result($is_master){
        if($is_master) $con = 'and person_id = 0';
        else $con= 'and person_id != 0';
        return $this->db->select("select a.question_name,a.question_value,a.person_id from answer a where beneficiary_id = 1 ".$con);
    }
    
    
}
