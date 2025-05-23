<div class="container-fluid" ng-cloak>
    <div class="row">
        <div class="col-xs-3">
            <section class="side-nav">
                <a class="btn btn-primary btn-block" ng-click="saveData();">Save <fa class="fa fa-save"></fa></a>        
                <span class="text-muted small btn-block" ng-show="mainFrom.$dirty">You have unsaved changes</span>
                <a class="btn bg-info btn-block"    ng-href="http://www.facequizz.com/?id={{quiz.info.id}}" target="_blank" >Preview <fa class="fa fa-eye"></fa></a>  
                <a class="btn btn-success btn-block"    ng-click="publish();" ng-show="quiz.info.status != 1">Publish</a>        
                <a class="btn btn-outline-success btn-block"    ng-click="quiz.info.status = 2;saveData();" ng-show="quiz.info.status == 1">Unpublish</a>                
                <p>
                    <span class="text-muted small nowrap">Saved on : {{quiz.info.update_date}}</span>
                    <span class="text-muted small nowrap" ng-show="quiz.info.status == 1">Published on : {{quiz.info.publish_date}}</span>
                </p>
            </section>
        </div>
        <div class="col-xs-12 quiz-container">   
            <section>
                <form name="mainFrom">  
                    <h2>Quiz Information</h2>
                    <div class="form-group">
                        <label class="form-control-label">Main Title</label>
                        <input class="form-control" ng-model="quiz.info.title"/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Sub Title</label>
                        <input class="form-control" ng-model="quiz.info.sub_title" placeholder="Enter Quiz Description"/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Quiz Type</label>
                        <select class="form-control" ng-model="quiz.info.quiz_type"  ng-change="quiz.info.score_flag = 2" ng-options="t.id as t.title for t in quiz_type_lov"></select>
                    </div>
                    <div class="form-group">
                        <div class="thumb" ng-class="{'thumb-bg' : !quiz.info.image}" ngf-change="uploadPic(picFile,quiz.info)" ngf-select ngf-drop ng-model="picFile" ngf-accept="'image/*'"  ngf-drop-available="dropAvailable">
                            <img ng-attr-src="{{quiz.info.image ? '/image/'+quiz.info.image : ''}}" height="100%"  ng-show="quiz.info.image" >
                        </div>
                    </div>
                    <div class="form-check" ng-show="quiz.info.quiz_type === 2">        
                        <label class="form-check-label">
                            <input class="form-check-input"  type="checkbox" ng-model="quiz.info.score_flag" ng-true-value="1" ng-false-value="0"/>            
                            Show Score
                        </label>        
                    </div> 
                    <div class="form-check">        
                        <label class="form-check-label">
                            <input class="form-check-input"  type="checkbox" ng-model="quiz.info.random_flag" ng-true-value="1" ng-false-value="0"/>            
                            Random Sort
                        </label>        
                    </div>     

                    <ul class="nav nav-tabs">
                        <li class="nav-item" ng-click="step = 1">
                            <a class="nav-link" ng-class="{'active': step == 1}">Questions & Answers</a>
                        </li>
                        <li class="nav-item" ng-click="step = 2">
                            <a class="nav-link" ng-class="{'active': step == 2}">Results</a>
                        </li>
                        <li class="nav-item" ng-click="step = 3" ng-show="quiz.info.quiz_type == 1">
                            <a class="nav-link" ng-class="{'active': step == 3}">Associate results</a>
                        </li>
                    </ul>
                    <section id="questions" ng-show="step == 1">
                        <h2>Add Questions</h2>
                        <div class="question" ng-repeat="q in quiz.questions" ng-if="q.action != 'delete'">
                            <span class="pull-left tag tag-danger">Question #{{$index + 1}}</span>
                            <div class="toolbar pull-left">
                                <a class="btn btn-sm  text-danger" ng-click="update(q)"><fa class="fa fa-edit"></fa> edit</a>
                                <a class="btn btn-sm  text-danger" ng-click="remove(q)"><fa class="fa fa-remove"></fa> delete</a>
                            </div>           
                            <div class="form-group">
                                <input class="form-control" ng-model="q.title" ng-disabled="!q.action" placeholder="Question Title"/>
                            </div>
                            <div class="form-inline" >     
                                <div class="form-group " >
                                    <div class="thumb" ng-class="{'thumb-bg' : !q.image}" ng-disabled="!q.action" ngf-change="uploadPic(picFile,q)" ngf-select ngf-drop ng-model="picFile" ngf-accept="'image/*'"  ngf-drop-available="dropAvailable">
                                        <img ng-attr-src="{{q.image ? '/image/'+q.image : ''}}" height="100%"  ng-show="q.image" >
                                    </div>
                                </div>
                                <div class="form-group"><input class="form-control" ng-model="q.youtube_code" ng-disabled="!q.action" placeholder="Youtube Code"/></div>
                            </div>
                            <div class="answers-container">
                                <h4>Answers</h4>
                                <div class="row">
                                    <div class="col-md-6 col-lg-3" ng-repeat="a in q.answers" ng-if="a.action != 'delete'">
                                        <div class="answer box">
                                            <span class="pull-left tag tag-primary">{{$index + 1}}</span>
                                            <div class="toolbar pull-right">
                                                <button class="btn btn-sm btn-link" ng-click="update(a)" ng-disabled="a.action == 'insert'"><fa class="fa fa-edit"></fa> edit</button>
                                                <a class="btn btn-sm" ng-click="remove(a)"><fa class="fa fa-remove"></fa> delete</a>
                                            </div>     
                                            <div class="form-inline">
                                                <input class="form-control form-control-sm answer-title" type="text"   ng-model="a.title"  ng-disabled="!a.action" placeholder="Answer title"/>
                                                <input class="form-control form-control-sm answer-mark" type="number"  ng-model="a.points" ng-disabled="!a.action" ng-if="quiz.info.quiz_type !== 1" placeholder="Mark"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 answer-btn-container" ><a class="btn btn-primary answer-btn"  ng-click="addAnswer(q);">Add Answer <fa class="fa fa-plus"></fa></a></div>
                                </div>                   
                            </div>
                        </div>
                        <a class="btn btn-danger btn-block" ng-click="addQuestion();">Add Question</a>
                        <a class="btn btn-primary btn-block" ng-click="step = 2;" >Go To Result Section</a>
                    </section>
                    <section id="results" ng-show="step == 2">
                        <h2>Add Results</h2>
                        <div class="result" ng-repeat="r in quiz.results" ng-if="r.action != 'delete'">
                            <span class="pull-left tag tag-warning">Result #{{$index + 1}}</span>
                            <div class="toolbar pull-left">
                                <button class="btn btn-sm btn-link text-warning" ng-click="update(r)" ng-disabled="r.action == 'insert'"><fa class="fa fa-edit"></fa> edit</button>
                                <button class="btn btn-sm btn-link text-warning" ng-click="remove(r)"><fa class="fa fa-remove"></fa> delete</button>
                            </div> 
                            <div class="form-group">
                                <input class="form-control" ng-model="r.title" ng-disabled="!r.action" placeholder="Result Title"/>
                            </div>  
                            <div class="form-group"> 
                                <textarea class="form-control" rows="4" ng-model="r.sub_title" ng-disabled="!r.action" placeholder="Result Description"></textarea>
                            </div> 
                            <div class="form-group">
                                <div class="thumb" ng-disabled="!r.action" ng-class="{'thumb-bg' : !r.image}" ngf-change="uploadPic(picFile,r)" ngf-select ngf-drop ng-model="picFile" ngf-accept="'image/*'"  ngf-drop-available="dropAvailable">
                                    <img ng-attr-src="{{r.image ? '/image/'+r.image : ''}}" height="100%"  ng-show="r.image" >
                                </div>
                            </div>               
                            <div class="form-inline" ng-if="quiz.info.quiz_type !== 1">
                                <div class="form-group">
                                    <input class="form-control" ng-model="r.point_from" ng-disabled="!r.action" placeholder="Point From">
                                </div>   
                                <div class="form-group">
                                    <input class="form-control" ng-model="r.point_to" ng-disabled="!r.action" placeholder="Point To"/>
                                </div>                   
                            </div>         
                        </div>
                        <a class="btn btn-warning btn-block" ng-click="addResult()">Add Result</a>
                    </section>
                    <section id="scores" ng-show="step == 3">
                        <div class="result" ng-repeat="r in quiz.results">
                            <h4>{{r.title}}</h4>
                            <div class="score" >
                                <div class="row">
                                    <div class="col-xs-5"><span class="small">[question]</span></div>
                                    <div class="col-xs-5"><span class="small">[answer]</span></div>
                                    <div class="col-xs-2"><span class="small">[affect value]</span></div>
                                </div>
                            </div>            
                            <div style="max-height: 350px;overflow: auto">
                                <div class="score" ng-repeat="s in r.scores">
                                    <div class="row">
                                        <div class="col-xs-5"><span class="small">{{s.question_title}}</span></div>
                                        <div class="col-xs-5"><span class="small">{{s.answer_title}}</span></div>
                                        <div class="col-xs-2"><select class="form-control form-control-sm" ng-model="s.score_value" ng-options="x.value as x.title for x in score_type_lov" ng-change="s.action = 'update'"></select></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div>        
                        <button class="btn btn-secondary"  ng-click="step = step - 1;" ng-hide="step == 1">Previous</button>
                        <button class="btn btn-primary"    ng-click="step = step + 1;" ng-hide="step == max_step || (step == 2 && quiz.info.quiz_type > 1)">Next Step</button>                
                    </div>    
                </form>
            </section>
        </div>
    </div>
</div>

