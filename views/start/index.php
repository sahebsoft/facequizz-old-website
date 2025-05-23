<? $i = 0 ;
$id = 0;
$quiz = $this->quiz;
?>
<center>
<div class="inline" id="right_col">  

   
    <div style="max-width:730px;text-align:right;">
    <h3><?=$this->title;?></h3><br/><br/>
    <p style="font-size: 18px;"><?=$this->description;?></p>
    <br/>
    <? if($this->image != '') { ?>
    <div id="image"  style="margin: 10px 0px;max-width: 600px;">
        <a style="width:100%;" href="<?=$this->url;?>" ><img style="width:100%" src="<?=$this->image;?>"/></a>
    </div>
    <? } ?>
    </div>
    <br/>
<? if($this->status == 1 ) {getAdSlot(7602428275);} ?>  
<div id="morequiz" style="text-align: right;">
    <h3>اختبر ايضا</h3>
    <? foreach($this->morequiz as $morequiz) {
    ?>
    <a class="newline" style="font-size:18px;" href="<?=  quizLink(array('quiz_id'=>$morequiz['id'],'ref'=>'morequiz'));?>"><?=$morequiz['title'];?></a>
    <?
    } 
    ?>
    <br/><br/>
</div>

</div>
</center>
