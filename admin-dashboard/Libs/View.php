<?php

class View {
    private $_viewPath = 'View/pages/';
    public $_title;
    public $_description;
    
    function __construct() {
        //echo __CLASS__ . " __construct<br>";
    }

    public function render($name, $noInclude = false) {
        if (file_exists($this->_viewPath . $name . '.php')) {
            if ($noInclude) {
                require $this->_viewPath . $name . '.php';
            } else {
                require $this->_viewPath . 'header.php';
                require $this->_viewPath . $name . '.php';
                require $this->_viewPath . 'footer.php';
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            $this->_title = "Page Not Found";
            require $this->_viewPath . 'header.php';
            require $this->_viewPath . 'error.php';
            require $this->_viewPath . 'header.php';
        }
    }
    
    public function getNgIf($NgShow =null,$NgHide =null){
        $ng_if = '';
        if (!empty($NgShow)) {
            $ng_if = 'ng-if="' . $NgShow . '"';
        }
        if (!empty($NgHide)) {
            $ng_if = 'ng-if="!(' . $NgHide . ')"';
        }
        return $ng_if;
    }
    public function print_option($question){
        $option = $question['question_option'];
        $label  = $question['question_label'];
        $option_count = count($question['question_option']);
        $label_count  = count($question['question_label']);        
        if($option_count == 0 && $label_count == 0) {
            echo '<input required class="form-control" type="'.$question['question_type'].'" name="q'.$question['question_id'].'" ng-model="data.q'.$question['question_id'].'" ng-disabled="disabled.q'.$question['question_id'].'"/>';
            return;
        }
       
        if($option_count > 0 && $label_count == 0){
            if($question['question_type'] == 'radio') {
                echo "<table class='table fill-last'>";
                foreach($option as $o){               
                    echo '<td><input required type="radio" value="'.$o['option_id'].'"  ng-model="data.s'.$o['question_id'].'" name="q'.$o['question_id'].'" id="q'.$o['question_id'].$o['option_id'].'"/></td><td><label for="q'.$o['question_id'].$o['option_id'].'">'.$o['option_title'].'</label></td></tr>';
                }
                echo "</table>";
            } else 
            {
            echo '<span class="pull-left label"><i class="fa fa-list-ol text-danger"></i></span>';
            echo '<select required class="form-control" name="data.s'.$question['question_id'].'" ng-model="data.s'.$question['question_id'].'"  ng-disabled="disabled.s'.$question['question_id'].'">';
            echo '<option style="display:none"></option>';
            foreach($option as $o){
                echo '<option value="'.$o['option_id'].'" ng-selected="data.s'.$question['question_id'].' ==  '.$o['option_id'].'">'.$o['option_title'].'</option>';
            }
            echo '</select>';
            }
            return;           
        }
        if($option_count == 0 && $label_count > 0){ ?>
            <span class="pull-left label"><i class="fa fa-th-list text-danger"></i></span>
            <table class="table table-striped <?=$label[1]['label_type'] =='checkbox' ? 'fill-first' : 'fill-first';?>">
                <tbody>
                    <? foreach($label as $l) { 
                        $name = 'q'.$l['question_id'].'_l'.$l['label_id'];
                        $model = 'data.'.$name;
                        $selectClass = $l['label_type'].'-selected';
                        $required = $l['label_type'] == 'checkbox' ? '' : 'required'; 
                        $NgIf = $this->getNgIf($l['ng-show'],$l['ng-hide']);
                    ?> 
                    <tr <?=$NgIf;?>>
                        <td ng-class="<?=$model;?> ?  '<?=$selectClass;?>' : ''">
                            <label for="<?=$name;?>"><?=$l['label_id'];?>. <?=$l['label_title'];?></label>                            
                        </td>
                        <td>
                            <input <?=$required;?> type="<?=$l['label_type'];?>" class="form-control" id="<?=$name;?>" name="<?=$name;?>" ng-model="<?=$model;?>" ng-true-value="1" ng-false-value="0"/>
                        </td>
                    </tr>
                    <? } ?>
                </tbody>
            </table>
        <? }
        if($option_count > 0 && $label_count > 0){ ?>
        <span class="pull-left label"><i class="fa fa-th text-danger"></i></span>
        <table class="table table-striped">
            <thead></thead>
            <tbody>
                <tr>                
                <td></td>
                <? foreach($option as $o) { ?>
                <td class="text-center"><?=$o['option_title'];?></td>                
                <? } ?>                
                </tr>
                <? foreach($label as $l) { 
                    $name = 'q'.$l['question_id'].'_l'.$l['label_id']; 
                    $NgIf = $this->getNgIf($l['ng-show'],$l['ng-hide']);
                ?>
                <tr <?=$NgIf;?>>
                    <td><?=$l['label_title'];?></td>
                    <? foreach($option as $o) { 
                        if($l['label_type'] == 'text' || $l['label_type'] == 'number' || $l['label_type'] == 'date') {  
                            $name = 'q'.$l['question_id'].'_l'.$l['label_id'].'_o'.$o['option_id'];    
                        }
                    ?>
                    <td class="text-center"><label><input required type="<?=$l['label_type'];?>" class="form-control" value="<?=$o['option_value'];?>" name="<?=$name;?>" ng-model="data.<?=$name;?>" /></label></td>
                    <? } ?>
                </tr>
                <? } ?>
            </tbody>
        </table>          
       <? }                  
    }   
}
