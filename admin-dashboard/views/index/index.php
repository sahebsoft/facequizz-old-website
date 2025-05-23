    <style>
        .thumb{
            background: #F8F8F8;
            border: 5px dashed #ddd;
            height: 200px;
            min-width: 200px;
            text-align: center;
            cursor: pointer;
        }
        .thumb-bg{
            background: url('/app/assets/images/upload-image.png') center center  no-repeat ;
            background-size: 160px; 
        }
        [disabled] {
            cursor: not-allowed;
        }
        p {
            margin: 1rem 0;
        }
        .side-nav{
            position: fixed;
            width: 250px;
            z-index: 99999;
        }
        .nowrap{
            white-space: nowrap;
            
        }
        .small{
            font-size: 70%;
        }
    </style>
<ng-view></ng-view>
