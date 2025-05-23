<?
$i = 0;
$id = 0;
$quiz = $this->quiz;
?>
<script>
    ga('send', 'event', {eventCategory: 'pageview', eventAction: 'Quiz Index Page'});
</script>
<center>

    <div class="inline" id="right_col">  
        <h1 style="font-size:24px;"><?= $this->quiz_title; ?></h1>
        <p><?=$this->description;?></p><br>
            
                <form class="form-horizontal" role="form" id="quiz_form" method="post" action="">
                    <?
                    foreach ($quiz as $question_id => $question) {
                        $i++;
                        ?>
                    <div id="<?= 'question' . $i; ?>" class="cont hide card" >
                    <div class="card-header">
                        <h4 style="font-size:24px;"><?= $question['question_title']; ?></h4>
                    </div>                    
                    <div class="card-block">
                        <div  style="max-width:730px;text-align:right;margin-top: 10px;">
                            <? if ($question['question_image'] != '') { ?>
                                <div id="image"  style="margin: 10px 0px;max-width: 600px;">
                                    <img  src="<?= IMAGE_PATH . $question['question_image']; ?>" style="max-width: 100%"/>
                                </div>
                            <? } ?>
                            <? if ($question['question_youtube_code'] != '') { ?>
                                <div id="video">

                                    <iframe width="560" height="315" src="<?= "https://www.youtube.com/embed/" . $question['question_youtube_code'] . "?rel=0&amp;controls=0&amp;showinfo=0"; ?>" frameborder="0" allowfullscreen></iframe>
                                </div>
                            <? } ?>        

                            
                        <div id="answers">
                            <table class="table table-striped">
                                <?
                                $j = 0;
                                foreach ($question['answer'] as $answer_id => $answer) {
                                    $j++;
                                    ?>
                                    <tr>
                                        <td width="35"><input class="radio" type="radio" value="<?= $answer_id; ?>" id="radio<?= $question_id . '_' . $answer_id; ?>" name="<?= $i; ?>"></td>
                                        <td><label for="radio<?= $question_id . '_' . $answer_id; ?>"><?= $answer['answer_title']; ?></label></td>
                                    </tr>                                                                       
                                <? }
                                ?>
                            </table>
                        </div>                            

                        </div> </div>
                            <div class="card-footer">
                                <? if ($i != count($this->quiz)) { ?>
                                    <a  id="<?= $i; ?>" class="next btn btn-success" type="button">السؤال التالي</a>
                                <? } else { ?>
                                    <input id="100" class="res btn btn-success" type="submit" onClick="ga('send', 'event', {eventCategory: 'click', eventAction: 'Quiz Finish'});" value="الحصول على النتيجة"/>
                                <? } ?>
                                <span style="margin: 10px;line-height: 32px;"><?= "السؤال $i من " . count($quiz); ?></span>
                                <br/>
                                <p id="error" class="text-danger hide">لم تقم بأختيار اي اجابة !</p>
                            </div>
                       
                    
                    </div>
                    <? } ?>
                </form>
            
        <div style="text-align: right;"><?
            if ($this->status == 1) {
                getAdSlot($this->ad_slot);
            }
            ?></div>
        <script>
            $('.cont').addClass('hide');
            count = $('.questions').length;

            $('#question' + 1).removeClass('hide');

            $(document).on('click', '.next', function () {

                element = $(this).attr('id');
                last = parseInt(element);
                nex = last + 1;
                val = $("input[name=" + element + "]:checked").val();
                if (typeof (val) === 'undefined') {
                    $('.text-danger').removeClass('hide');
                } else {
                    $('.text-danger').addClass('hide');
                    $('.cont').addClass('hide');
                    $('#question' + last).addClass('hide');
                    $('#question' + nex).removeClass('hide');
                }
            });

            $(document).on('click', '.previous', function () {
                $('.cont').addClass('hide');
                element = $(this).attr('id');
                last = parseInt(element.substr(element.length - 1));
                pre = last - 1;
                $('#question' + last).addClass('hide');

                $('#question' + pre).removeClass('hide');
            });
        </script>
    </div>
</center>