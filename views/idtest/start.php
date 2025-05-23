<? 
$quiz = $this->quiz;

?>
<script>
ga('send', 'event', { eventCategory: 'pageview', eventAction: 'Quiz Start Page'});
</script>
<center>
<div class="inline" id="right_col">  

    <div style="max-width:730px;text-align:right;">
        <center>
            <? if($this->status == 1 ) {
                                getAdSlot2($this->ad_slot);} 
                                ?>
    <? if( isset($this->image)) { ?>
    <div id="image"  style="margin: 10px 0px;max-width: 600px;">
        <a  href="<?=quizLink(array('quiz_id'=>$this->quiz_id))."&s=1".$this->ref;?>" onClick="ga('send', 'event', { eventCategory: 'clickstart', eventAction: 'Quiz Start Image'});"> <img style="width:100%" src="<?=$this->quiz_image;?>"/></a>
    </div>
     <? } ?>
    <h3><?=$this->quiz_title;?></h3><br/><br/>
    <p class="h4"><?=$this->description;?></p>
    <br/><br/>
    <? if($this->status == 1 ) {getAdSlot($this->ad_slot);} ?>
    <br/>
    <br/><a  href="<?=quizLink(array('quiz_id'=>$this->quiz_id))."&s=1".$this->ref;?>" class="btn btn-primary"  onClick="ga('send', 'event', { eventCategory: 'clickstart', eventAction: 'Quiz Start Button'});">ابدأ الاختبار</a>
        </center>
    </div>    
     
   


<div id="comments" class="m-t-1">
	<fb:comments href="http://www.facequizz.com/?q=<?=$this->quiz_id;?>" data-width="100%" num_posts="10"></fb:comments>
</div>  

</div>
    

</center>

        <div class="card m-t-2 text-xl-right">
            <div class="card-header"><h2>اختبارات قد تعجبك</h2></div>
            <div class="card-block">
                <? foreach($this->morequiz as $q) { ?>
                <div class="more-quiz">
                    <a href="<?=  quizLink(array('quiz_id'=>$q['id']));?>" class="d-block bold" title="<?=$q['title'];?>"><?=$q['title'];?> </a>
                    <small class="text-muted"><?=$q['sub_title'];?></small>
                </div>
                <? } ?>
            </div>
        </div>
