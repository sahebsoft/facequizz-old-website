<?php
 
class Attribute{
    public $Name;
    public $DefaultValue;
    public $Label;
    public $ColumnName;
    public $TableName;
    public $Type;
    public function __construct($Name,$DefaultValue,$Label,$ColumnName,$TableName,$Type) {
        $this->Name = $Name;
        $this->DefaultValue = $DefaultValue;
        $this->Label        = $Label;
        $this->ColumnName   = $ColumnName;
        $this->TableName    = $TableName;
        $this->Type         = $Type;
    }

}