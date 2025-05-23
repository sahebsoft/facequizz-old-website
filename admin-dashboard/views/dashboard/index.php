<section>
<h1>Quiz List
    <button class="btn btn-success pull-right" ng-click="createQuiz();" ng-disabled="loading">Create New Quiz <fa class="fa fa-plus" ng-class="{'fa-spin' : loading}"></fa></button>
</h1>

<input class="form-control" placeholder="search for quiz" ng-model="quizSearch">

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <td>Id</td>
            <td>Title</td>
            <td>Status</td>
            <td>Create User</td>
            <td>Create Date</td>
            <td>Operation</td>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="quiz in quizes  |filter:quizSearch " ng-cloak>
            <td>{{quiz.id}}</td>
            <td>{{quiz.title}}</td>
            <td>{{quiz.status == 1 ? 'active' : 'inactive'}}</td>
            <td>{{quiz.username}}</td>
            <td>{{quiz.create_date| date}}</td>
            
            <td>
                <a ng-href="{{'#/quiz/'+quiz.id}}" title="Edit"><fa class="fa fa-edit"></fa></a>
                <a ng-href="{{'/?id='+quiz.id}}" target="_blank" title="View"><fa class="fa fa-eye text-danger"></fa></a>
            </td>
        </tr>
    </tbody>
</table>
</section>