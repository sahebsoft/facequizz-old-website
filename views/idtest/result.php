<? 
$quiz = $this->quiz;
$res = $this->result;
?>
<script>
ga('send', 'event', { eventCategory: 'pageview', eventAction: 'Quiz Result Page'});
</script>
<center>
<div class="inline" id="right_col"> 
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- facequizz_result_page -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6154079892224305"
     data-ad-slot="8236445879"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <div style="text-align: right;">
        
</div>    
<h1 style="font-size: 24px;"><?=$res[0]['title'];?>
    <strong style="display: block;">
    <? if(isset($_COOKIE['resultdesc_'.$this->quiz_id]) && $this->score_flag == "1") {  
        echo $_COOKIE['resultdesc_'.$this->quiz_id];
    }
    ?>
</strong>
</h1>    
      <br/>
    <? if($res[0]['image'] != '') { ?>
    <div id="image"  style="margin: 10px 0px;max-width: 500px;max-height:500px;">
        <a style="width:100%;" href="#"  onClick="ga('send', 'event', { eventCategory: 'click', eventAction: 'Quiz Repeat'});"><img style="width:100%" src="<?=IMAGE_PATH.$res[0]['image'];?>"/></a>
    </div>
    <? } ?>
      <div id="desc" style="margin: 20px;font-size:22px;"><?=nl2br($res[0]['sub_title']);?></div>  

        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- facequizz_result_page -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6154079892224305"
     data-ad-slot="8236445879"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

    <br/>
    <span>اعجبتك النتيجة ؟ قم بمشاركتها مع اصدقائك على الفيسبوك</span> 
    <br/><br/>
    <div style="text-align: center;overflow: visible;">
        <div style="overflow: visible;" class="fb-like" data-href="<?=quizLink(array('quiz_id'=>$this->quiz_id)).'&r='.$this->result_id;?>" data-width="300" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>

    </div>
    <a href="<?=URL."redirect/$this->quiz_id/$this->result_id";?>" target="_blank"  class="fbbtn" onClick="ga('send', 'event', { eventCategory: 'click', eventAction: 'Quiz Share'});">شارك النتيجة على الفيسبوك</a>
    <br/>
    <? $qq = 'اختبار' ; ?>
   <? /* <a href="<?=URL."redirect/$this->quiz_id/$this->result_id";?>" target="_blank"  class="fbbtn">شارك النتيجة على الفيسبوك</a>
    <a href="https://twitter.com/intent/tweet?text=%23<?=$qq.' '.$this->quiz_title.'%0Aنتيجتي كانت :'.substr($res[0]['title'],0,80).'... ورونا نتائجكم%0A';?>&url=<?=urlencode($this->url);?>" target="_blank" class="twbtn">شارك النتيجة على تويتر</a>
    <a href="<?=URL."redirect/$this->quiz_id/";?>" target="_blank"  class="fbbtn">شارك الاختبار على الفيسبوك</a>
    <a href="https://twitter.com/intent/tweet?text=%23<?=$qq.' '.$this->quiz_title.'%0Aورونا نتائجكم%0A';?>&url=<?=urlencode($this->quiz_url)."&hashtags=facequizz";?>" target="_blank" class="twbtn">شارك الاختبار على تويتر</a>
    */ ?>
    <br><br><a  href="<?=quizLink(array('quiz_id'=>$this->quiz_id)).$this->ref;?>" style="font-size:18px;color:#000;"  onClick="ga('send', 'event', { eventCategory: 'click', eventAction: 'Quiz Repeat'});" >اعادة الاختبار</a>
    <br><br><a  href="<?=DOMAIN.$this->ref;?>" style="font-size:18px;color:#000;" onClick="ga('send', 'event', { eventCategory: 'click', eventAction: 'More Quiz'});">المزيد من الاختبارات</a>
        <br/>
   

</div>
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
     
     <div id="comments" style="margin-top:20px;">
	<fb:comments href="http://www.facequizz.com/?q=<?=$this->quiz_id;?>" data-width="100%" num_posts="10"></fb:comments>
</div>  
     
  <? if ($_GET['ref'] =='ad') { ?>   
     <script type='text/javascript'>
    jQuery(document).ready(function ($) {
        if ($.cookie('popup_user_login') !== 'yes' ) {
            $('.modal').delay(10).fadeIn('medium');
            $('.modal').delay(7000).fadeOut('medium');
            $('.closepop').click(function () {
                $('.modal').stop().fadeOut('medium');
            });
        }
        $.cookie('popup_user_login', 'yes', {path: '/', expires: 7});
    });
    FB.Event.subscribe('edge.create', function(response) {
$('.modal').stop().fadeOut('medium');
});
</script>
  <? } ?>

<div class="modal">
    <div class="modal-table">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h3>اضغط اعجاب لكي تحصل على نتيجتك</h3>
                </div>
                <div class="modal-body">
              <div class="fb-like" data-href="http://www.facebook.com/facequizz" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
                <div class="modal-footer">
                    <p>النتيجة تظهر مباشرة فقط لاعضاء صفحة اختبارات الفيسبوك</p>
                    <button type="button" class="btn btn-danger closepop "  style="display: none;">اغلاق</button>
                </div>
            </div><!-- .modal-content -->
        </div>
    </div>
</div>