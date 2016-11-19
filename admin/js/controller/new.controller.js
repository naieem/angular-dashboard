app.controller('NewCtrl', NewCtrl);
NewCtrl.$inject = ['$scope', 'Articles', '$state', '$timeout'];

function NewCtrl($scope, Articles, $state, $timeout) {
    $scope.tinymceOptions = {
        theme: 'modern',
        width: 1200,
        height: 300,
        plugins: ['advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker', 'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking', 'save table contextmenu directionality emoticons template paste textcolor'],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
    };
    $scope.AddArticle = function() {
        $scope.msg = "<img src='./img/default.gif'>";
        let info = {
            title: $scope.title,
            description: $scope.description,
            action: "create_new"
        }
        Articles.create(info, function(data) {
            $scope.msg = data.msg;
            $timeout(function() {
                console.log('done');
                $state.go('home');
            }, 1000);
            console.log(data.insertId);
        });
    }
}