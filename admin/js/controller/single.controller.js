app.controller('SingleCtrl', SingleCtrl);
SingleCtrl.$inject = ['$scope', 'Articles', '$stateParams', '$timeout', '$state'];

function SingleCtrl($scope, Articles, $stateParams, $timeout, $state) {
    var vm = this;
    var id = $stateParams.id;
    let info = {
        id: id,
        action: "searchArticle"
    }
    Articles.get(info, function(data) {
        vm.users = data;
        console.log(data);
    });
    $scope.EditArticle = function() {
        //alert(vm.users.title);
        vm.msg = "<img src='./img/default.gif'>";
        let info = {
            id: id,
            title: vm.users.title,
            description: vm.users.description,
            action: "update"
        }
        Articles.update(info, function(data) {
            vm.msg = data.msg;
            $timeout(function() {
                console.log('done');
                $state.go('home');
            }, 1000);
            console.log(data);
        });
    }
    $scope.tinymceOptions = {
        theme: 'modern',
        width: 1200,
        height: 300,
        plugins: ['advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker', 'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking', 'save table contextmenu directionality emoticons template paste textcolor'],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
    };
}