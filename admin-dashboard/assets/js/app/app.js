angular.module('myApp',['ngRoute','ngFileUpload']).config(['$routeProvider', function($routeProvider) {
  $routeProvider
    .when('/quiz/:id', {
      templateUrl: '/app/views/quiz',
      controller : 'quizCtrl'
    }).otherwise({
        templateUrl : '/app/views/dashboard',
        controller  : 'dashboardCtrl'
    });
}]);
angular.module('myApp').controller('dashboardCtrl',function($scope,$http){
    $scope.quizes = [];
    $scope.loading = false;
    $http.get('/app/api/quiz_list').success(function(data){
        $scope.quizes = data;
    });
    $scope.createQuiz = function(){
        $scope.loading = true;
        $http.get('/app/api/create_quiz').success(function(data){
            if(data.status == 'success'){
                window.location = "/app/#/quiz/"+data.id;
            } else {
                alert(data.msg);
            }
        });
    };
});

angular.module('myApp').controller('quizCtrl',function($scope,$http,$routeParams,Upload,$timeout){    
    $scope.quiz = {};
    $scope.step = 1;
    $scope.max_step = 3;
    var quizId = 0;
       
    $scope.$watch('step', function () {
        if($scope.step == 3){
            $scope.saveData();
        }
    });
    
  $scope.uploadPic = function (file,obj) {
    if (file != null) {
      uploadUsingUpload(file,obj);
    }
  }; 
  function uploadUsingUpload(file,obj) {
    file.upload = Upload.upload({
      url: '/app/upload',
      headers: {'optional-header': 'header-value'},
      data: {file: file}
    });

    file.upload.then(function (response) {
        obj.image = response.data.image_name;
        $scope.saveData();
    }, function (response) {
      if (response.status > 0)
        $scope.errorMsg = response.status + ': ' + response.data;
    }, function (evt) {
      file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
    });
  }


    $scope.quiz_type_lov = [{id:1,title:'Personality'},{id:2,title:'Points'},{id:3,title:'Puzzle'}];
    $scope.score_type_lov = [{value:-9999,title:'-9999'},{value:-3,title:'-3'},{value:-2,title:'-2'},{value:-1,title:'-1'},{value:0,title:'no effect'},{value:1,title:'+1'},{value:2,title:'+2'},{value:3,title:'+3'},{value:9999,title:'+9999'}];
    
    $scope.getData = function(){
        $http.get('/app/api/get_quiz/'+$routeParams.id).success(function(data){
            if(!data) window.location  = '/app/';
            else {
                $scope.quiz = data;           
                if($scope.quiz.questions.length === 0) $scope.addQuestion();
                if($scope.quiz.results.length === 0) $scope.addResult();
                quizId = $scope.quiz.info.id;
            }
        });  
    };
    $scope.getData();
    
    $scope.addQuestion = function(){
        if(typeof $scope.quiz.questions == "undefined") $scope.quiz.questions = [];
        $scope.quiz.questions.push({action:'insert',answers:[{action:'insert'},{action:'insert'}]});
    };   
    $scope.addAnswer = function(question){
        if(typeof question.answers == "undefined") question.answers = [];
        question.answers.push({action:'insert'});
    };
    $scope.addResult= function(){
        if(typeof $scope.quiz.results == "undefined") $scope.quiz.results = [];
        $scope.quiz.results.push({action:'insert'});
    };     
    $scope.update = function(row){
        row.action = 'update';
    };  
    $scope.remove = function(row){
        row.action = 'delete';        
    };    
    $scope.saveData = function(){
        $http.post('/app/api/save_quiz/'+$routeParams.id,$scope.quiz).success(function(data){
            console.log(JSON.stringify(data));
            $scope.getData();//get data to remove all actions : insert or update
            $scope.mainFrom.$dirty = false;
        }).error(function(){
            alert("Error in save");
        });
        
    };
    $scope.publish = function(){
        $scope.quiz.info.status = 1;
        $scope.saveData();
    };
    $scope.preview = function(){        
        $scope.saveData();
        window.open("http://www.facequizz.com/?id="+$scope.quiz.info.id, '_blank');
    };    
});