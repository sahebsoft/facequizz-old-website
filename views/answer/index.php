<? 
$quiz = $this->quiz;
$questions = $this->questions;
?>
<style>
    .answer-container{
        padding: 1rem;
        margin: 1rem;
        border: 5px dashed #ddd;
    }
    .answer-container p {
        font-size: 22px;
    }
</style>
<script>
ga('send', 'event', { eventCategory: 'pageview', eventAction: 'Qesutions Page'});
</script>
<div class="inline" id="right_col">  
    <div style="max-width:730px;text-align:right;">

    <h3><?=$quiz[0]['question_title'];?></h3>    
    <p style="font-size: 18px;"><?=$this->description;?></p>
    <p>هذا السؤال من اختبار : <a href="<?=quizLink(array('quiz_id'=>$this->quiz_id));?>" title="<?=$quiz[0]['quiz_title'];?>"><?=$quiz[0]['quiz_title'];?></a></p>
    <div class="m-a-1">
    <?=  getAdSlot(7602428275);?>
    </div>
    

    <div class="answer-section">
    <? 
    foreach($quiz as $key=>$answer){ ?>
        <? if($answer['points']>=1) {?><h3>الاجابات</h3>
        <div class="answer-container">
            <p class="answer"><?=$answer['answer_title'];?></p>
        </div>
        <? } ?>
    <? } ?>
    </div>
   
        <? if($quiz[0]['question_image'] != '') { ?>
    <div id="image"  style="margin: 10px 0px;max-width: 600px;">
        <img src="<?=IMAGE_PATH.$quiz[0]['question_image'];?>" alt="<?=$quiz[0]['question_title'];?>"/>
    </div>
     <? } ?>
    
    </div>  
    <h2>هل لديك اجابة اخرى ؟ - <?=$quiz[0]['question_title'];?></h2>
<div id="comments" style="margin-top:20px;">
	<fb:comments href="<?=questionLink(array('id'=>$this->id));?>" data-width="100%" num_posts="10"></fb:comments>
</div>      
     
<br/>
<h2>أسئلة اخرى</h2>
<ul>
    <? foreach($questions as $question){ ?>
    <li><a href="<?=questionLink(array('id'=>$question['question_id']));?>" title="<?=$question['question_title'];?>"><?=$question['question_title'];?></a></li>
    <? } ?>
</ul>
  <br/>
<?=getRepAdSlot(7602428275);?>

</div>
