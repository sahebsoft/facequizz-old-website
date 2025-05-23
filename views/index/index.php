<? $quizzes = $this->quizzes; ?>
<div class="text-xs-center"> 
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
</div>
<div class="inline" id="right_col">
    <style>
        .quiz_box{  
            padding:1rem;
            margin: 1rem;
            border:dashed 3px #545454;            
        }
        .quiz_box .quiz_img{
            display: inline-block;
        }
        .col-md-6{
            float: right;
        }
        .quiz_box .btn{
            margin-top: 1rem;
        }
    </style>
    <div>
        <h3>أشهر اختبارات الفيسبوك</h3>

        <? foreach ($quizzes as $quiz) { ?>
            <div class="quiz_box">
                <div class="row text-xs-center text-md-right">
                <div class="quiz_img col-md-5">
                    <img src="<?= IMAGE_PATH.$quiz['image']; ?>" title="<?= $quiz['title']; ?>" alt="<?= $quiz['title']; ?>"/>
                </div>
                <div class="quiz_body col-md-7">
                <a href="<?= quizLink(array('quiz_id' => $quiz['id'])) . $this->ref; ?>" style="font-size:20px;" ><?= $quiz['title']; ?></a>
                <p><?= mb_substr($quiz['sub_title'],0,100)."...";?></p>
                </div>                
                </div>  
                <a  href="<?= quizLink(array('quiz_id' => $quiz['id'])) . $this->ref; ?>" class="btn btn-block btn-primary" title="<?= $quiz['title']; ?>">ابدأ الاختبار</a>
            </div>
        <? } ?>
    </div>

</div>
<p>أسئلة متنوعة</p>
<? foreach ($this->questions as $question) { ?>
    <span><a href="<?= questionLink(array('id' => $question['question_id'])); ?>" title="<?= $question['question_title']; ?>"><?= $question['question_title']; ?></a></span> - 
<? } ?>