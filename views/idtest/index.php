<?
$i = 0;
$id = 0;
$quiz = $this->quiz;
$question = $this->question;
$question_id = $question['question_id'];
$i = $question['question_index'];
?>
<script>
    ga('send', 'event', {eventCategory: 'pageview', eventAction: 'Quiz Index Page'});
</script>

    <div class="inline text-xs-center" id="right_col" ng-app="quizApp" ng-controller="quizCtrl" > 
        <h1 style="font-size:24px;"><?= $this->quiz_title; ?></h1>
        <p><?=$this->description;?></p><br>
        <? if ($this->status == 1) {getAdSlot2($this->ad_slot);}?>
        <div class="card m-t-1 m-b-1">
            <div class="card-header">
                <p class="questions bold" style="font-size: 22px;"><?= $question['question_title']; ?></p>
            </div>
            <div class="card-block">
                
                <form class="form-horizontal" role="form" id="quiz_form" method="post" action="" >
                    <?

                    ?>
                    <div ng-init="quiz_id = <?= $question['quiz_id']; ?>;question_id = <?= $question['question_id']; ?>" class="cont" style="max-width:730px;text-align:right;margin-top: 10px;">
                        
                        <? if ($question['question_image'] != '') { ?>
                            <div id="image"  style="max-width: 600px;">
                                <img  src="<?= IMAGE_PATH . $question['question_image']; ?>" style="max-width: 100%"/>
                            </div>
                        <? } ?>
                        <? if ($question['question_youtube_code'] != '') { ?>
                            <div id="video">
                                <iframe width="560" height="315" src="<?= "https://www.youtube.com/embed/" . $question['question_youtube_code'] . "?rel=0&amp;controls=0&amp;showinfo=0"; ?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                        <? } ?>        
                        <div id="answers" style="max-width:730px;text-align:right;margin-top: 1rem;">
                            <table class="table table-striped">
                                <?
                                $j = 0;
                                foreach ($question['answer'] as $answer_id => $answer) {
                                    $j++;
                                    ?>
                                    <tr>
                                        <td width="35"><input style="margin: 2px 5px 2px 5px;height: 20px;width: 22px;" type="radio" value="<?= $answer_id; ?>" id="radio<?= $question_id . '_' . $answer_id; ?>" name="<?= $i; ?>" ng-model="answer"></td>
                                        <td><label for="radio<?= $question_id . '_' . $answer_id; ?>" style="display:block;font-size:16px;cursor: pointer;padding: 0.5rem;"><?= $answer['answer_title']; ?></label></td>
                                    </tr>                                                                       
                                <? }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div  style="max-width:730px;text-align:right;margin: 10px 0;"><?
                        if ($this->status == 1) {
                            getAdSlot2($this->ad_slot);
                        }
                        ?></div>                    
                </form>

            </div>
        </div>
        <div style="max-width:730px;text-align:center;">
            <? if ($i != $this->question_count) { ?><a href="<?= questionPage($question); ?>" id="<?= $i; ?>" class="next btn btn-primary">السؤال التالي</a><? } else {
                ?><a   ng-click="getResult();" class="res btn btn-default" type="submit" onClick="ga('send', 'event', {eventCategory: 'click', eventAction: 'Quiz Finish'});">الحصول على النتيجة</a><? } ?>
            <span style="margin: 10px;line-height: 32px;" class="text-nowrap"><?= "السؤال $i من " . $this->question_count; ?></span>
            <br/>
            <p id="error" class="text-danger hide">حدد الإجابة للانتقال للسؤال التالي</p>
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
        <script>
                    angular.module('quizApp').controller('quizCtrl', function ($scope,$http) {
                        $scope.$watch('answer', function (newVal, oldVal) {
                            var key = 'quiz_' + $scope.quiz_id;
                            $scope.answers =  JSON.parse(localStorage.getItem(key)) || {};
                            if(newVal){                                
                                $scope.answers[$scope.question_id] = newVal;
                                localStorage.setItem(key, JSON.stringify($scope.answers));
                                //console.log($scope.answers);
                            }
                            $scope.getResult = function(){
                                $scope.post = {quiz_id:$scope.quiz_id,answers:$scope.answers};
                                $http.post('/id/'+$scope.quiz_id,{quiz_id:$scope.quiz_id,answers:$scope.answers}).success(function(data){
                                    if(data.loc) {
                                        window.location = data.loc;
                                    }
                                }).error(function(){
                                    console.log('error');
                                });
                            };
                        });
                    });
        </script>
        <script>
                    count = $('.questions').length;

                    $('#question' + 1).removeClass('hide');

                    $(document).on('click', '.next', function (event) {

                        element = $(this).attr('id');
                        last = parseInt(element);
                        nex = last + 1;
                        val = $("input[name=" + element + "]:checked").val();
                        if (typeof (val) === 'undefined') {
                            event.preventDefault();
                            $('.text-danger').removeClass('hide');
                        }
                    });

        </script>
    </div>
