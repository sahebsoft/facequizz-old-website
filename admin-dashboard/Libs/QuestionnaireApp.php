<?php

class QuestionnaireApp extends View  {
        
    public function getType($type){
        if($type == 'text' || $type == 'number' || $type =='date' || $type == 'year') {
            return 'input';
        } else if($type == 'select' || $type == 'radio'){
            return 'option';
        } else if($type == 'multi_select') {
            return 'option';
        } else if($type == 'multi_question'){
            return $type;
        }
        return $type;
    }    
    
    public function getNgIf($NgShow =null,$NgHide =null){
        $ng_if = '';
        if (!empty($NgShow)) {
            $ng_if = 'ng-if="'.$NgShow.'"';
        }
        if (!empty($NgHide)) {
            $ng_if = 'ng-if="!('.$NgHide.')"';
        }
        return $ng_if;
    }
    
    public function print_option($question){ 
        $type   = $question['question_type'];
        $label  = $question['sub_question'];
        $option = $question['question_option'];
        $option_count = count($question['question_option']);
        if($this->getType($type) == 'input') {
            $name  = 'input_'.$question['question_no'];
            $model = 'data.'.$name;
            echo '<input required class="form-control" type="'.$question['question_type'].'" name="'.$name.'{{$index}}" ng-model="'.$model.'" ng-disabled="disabled.input_'.$question['question_no'].'"/>';
            return;
        }
       
        if($type == 'select'){    
            $name  = 'option_'.$question['question_no'];
            $model = 'data.'.$name;
            $other_model = 'data.other_'.$question['question_no'];            
            if($option_count < 4) {
                echo "<table class='table fill-last'>";
                foreach($option as $o){               
                    echo '<td><label><input required class="pull-right" type="radio" value="'.$o['option_id'].'"  ng-model="'.$model.'" name="'.$name.'{{$index}}"/>'.$o['option_title'].'</label></td></tr>';
                }
                echo "</table>";
            } else 
            {
            echo '<span class="pull-left label"><i class="fa fa-list-ol text-danger"></i></span>';
            echo '<select required class="form-control" name="'.$name.'{{$index}}" ng-model="'.$model.'"  ng-disabled="disabled.option_'.$question['question_no'].'">';
            echo '<option style="display:none"></option>';
            foreach($option as $o){
                echo '<option value="'.$o['option_id'].'" ng-selected="'.$model.' ==  '.$o['option_id'].'">'.$o['option_title'].'</option>';
            }
            echo '</select>';
            } ?> 
            <input required type="text" class="form-control form-other" placeholder="حدد أخرى" ng-if="<?=$model;?> == 9999" ng-model="<?=$other_model;?>">
            <? 
            return;           
        }
        if($type == 'multi_select'){ ?>
            <span class="pull-left label"><i class="fa fa-th-list text-danger"></i></span>
            <table class="table table-striped fill-first">
                <tbody>
                    <? foreach($option as $o) { 
                        $name = 'option_'.$question['question_no'].'_'.$o['option_id'];
                        $other = 'data.option_'.$question['question_no'].'_9999';
                        $other_name  = 'other_'.$question['question_no'];
                        $other_model = 'data.'.$other_name;
                        $model = 'data.'.$name;
                    ?> 
                    <tr>
                        <td ng-class="<?=$model;?> > 0 ?  'checkbox-selected' : ''">
                            <label><?=$o['option_title'];?><input  type="checkbox" class="form-control pull-left" name="<?=$name;?>{{$index}}" ng-model="<?=$model;?>" ng-true-value="<?=$o['option_id'];?>" ng-false-value="-999"/></label>                                                        
                        </td>
                    </tr>
                    <? } ?>
                </tbody>
            </table>
            <input required type="text" class="form-control form-other" placeholder="حدد أخرى" ng-if="<?=$other;?> == 9999" name="<?=$other_name;?>{{$index}}" ng-model="<?=$other_model;?>">
        <? }
        if($type == 'multi_question'){ ?>
        <span class="pull-left label"><i class="fa fa-th text-danger"></i></span>
        <table class="table table-striped">
            <thead></thead>
            <tbody>
                <? if($option_count > 0)  { ?>
                <tr>                
                <td></td>
                <? foreach($option as $o) { ?>
                <td class="text-center"><?=$o['option_title'];?></td>                
                <? } ?>                
                </tr>
                <? } ?>
                <? 
                $showOther = $this->getNgIf(false,true);
                foreach($label as $l) { 
                    $name = $this->getType($l['question_type']).'_'.$l['question_no'];
                    $NgIf = $this->getNgIf($l['ng-show'],$l['ng-hide']);
                    $other_name  = 'other_'.$question['question_no'];
                    $other_model = 'data.'.$other_name;
                    if($l['sub_question_id'] == 9999) {
                        $showOther = $NgIf;
                    }
                ?>
                <tr <?=$NgIf;?>>
                    <td><?=$l['question_title'];?></td>
                    <? if($option_count == 0) { ?>
                    <td class="text-center"><label><input required type="<?=$l['question_type'];?>" class="form-control"  name="<?=$name;?>{{$index}}" ng-model="data.<?=$name;?>" /></label></td>
                    <? } 
                    else foreach($option as $o) { 
                        if($this->getType($l['question_type']) =='input') {  
                            $name = 'input_'.$l['question_no'].'_'.$o['option_id'];    
                        }
                    ?>
                    <td class="text-center"><label><input required type="<?=$l['question_type'];?>" class="form-control" value="<?=$o['option_id'];?>" name="<?=$name;?>{{$index}}" ng-model="data.<?=$name;?>" /></label></td>
                    <? } ?>
                </tr>
                <? } ?>
            </tbody>
        </table>      
        <input  type="text" class="form-control form-other" placeholder="حدد أخرى" <?=$showOther;?> name="<?=$other_name?>{{$index}}" ng-model="<?=$other_model;?>">
       <? }                  
    }   
    
    public function print_question($section){    
        foreach($section as $question){ 
            $ng_if = $this->getNgIf($question['ng-show'],$question['ng-hide']);
            ?>
        <div class="form-group" <?= $ng_if; ?>>
            <span class="question-no label label-primary pull-right"><?= $question['question_id']; ?></span>
            <label class="control-label"><?=$question['question_title'];?></label>
            <? $this->print_option($question);?>
        </div>
        <? } 
    }
    
    public function print_section($arr){
        foreach($arr as $section){ 
            $section_id = $section['section_id'];
            $section_title = $section['section_title'];
    ?>
        <form name="section<?= $section['section_id']; ?>" id="section<?= $section['section_id']; ?>" ng-show="step == <?= $section['section_id']; ?>" ng-submit="postData(section<?= $section['section_id']; ?>)" novalidate>

            <h3 class="widget-title"><?=$section_title;?></h3>
                <? if($section['section_id'] == '1'){ ?>
                <div ng-repeat="data in data.family" >
                    <div  style="padding: 15px;margin:15px;border: 4px solid #ddd;" >
                         <? $this->print_question($arr[$section_id]['question']);?>
                    </div>
                </div>
                <input type="button" class="btn btn-lg btn-danger btn-block" ng-show="step == 1 && data.family.length > 1"   value="حذف اخر فرد" ng-click="deleteChild()"/>
                <input type="button" class="btn btn-lg btn-success btn-block" ng-show="step == 1 "   value="اضافة فرد جديد" ng-click="addChild()"/>            
                
                <div class="form-group" style="margin-top:15px;">
                    <span class="question-no label label-primary pull-right">199</span>
                    <label class="control-label">الفرد المستجيب</label>    
                    <select  required class="form-control" name="input_199_0_0" ng-model="data.input_199_0" ng-options="option.input_101_0 as option.input_102_0 for option in data.family">
                        <option value="" style="display: none;"></option>
                    </select>
                </div>
                
                <? } else { $this->print_question($arr[$section_id]['question']);} ?>                

        <div class="row section-control">
            <div class="col-xs-4"><input type="button" class="btn btn-lg btn-danger btn-block"  ng-show="step > 1"   value="القسم السابق" ng-click="back()"/></div>
            <div class="col-xs-4"><input type="submit" class="btn btn-lg btn-success btn-block" ng-show="step == 10"  value="انهاء و حفظ البيانات"/></div>
            <div class="col-xs-4"><input type="submit" class="btn btn-lg btn-primary btn-block" ng-show="step < 10"   value="القسم التالي"/></div>  
        </div>   
    </form>
        <?   
        }    
    }    
}

