<?php

class Sitemap_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getApps(){
        return $this->db->select("SELECT alias,fetch_date from app_info  a,apkhotel b
            where a.status = 1
            and   b.status = 1 
            and   a.id = b.id
            order by fetch_date desc");
    }    
    public function getCats(){
        return $this->db->select("SELECT alias from cats where status = 1 ");
    }  
}
?>