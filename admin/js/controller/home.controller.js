app.controller('HomeCtrl', HomeCtrl);
HomeCtrl.$inject = ['$scope', 'Articles'];

function HomeCtrl($scope, Articles) {
    var vm = this;
    vm.currentPage = 1;
    vm.numPerPage = 10;
    vm.maxSize = 5;
    vm.loader = "<img src='img/squares.gif'>";
    let info = {
        action: "getall"
    }
    vm.getAll = function() {
        Articles.query(info, function(data) {
            console.log(data);
            vm.users = data;
            vm.loader = "";
        });
    }
    vm.getAll();
    $scope.sortingLog = [];
    $scope.sortableOptions = {
        // called after a node is dropped
        stop: function(e, ui) {
            //console.log(ui.item);
            $scope.t = [];
            var logEntry = vm.users.map(function(i) {
                $scope.t.push(i.id);
                return i.title;
            }).join(', ');
            $scope.sortingLog.push('final: ' + logEntry + '   ' + $scope.t);
            console.log($scope.sortingLog);
            var jsonString = JSON.stringify($scope.t);
            //console.log(jsonString);
            let info = {
                id: jsonString,
                action: "update"
            }
            Articles.query(info, function(data) {
                console.log(data);
                //$scope.list = data;
            });

        },
        update: function(e, ui) {
            console.log("update");
            var logEntry = vm.users.map(function(i) {
                return i.title;
            }).join(', ');
            $scope.sortingLog.push('Update: ' + logEntry);
            console.log($scope.sortingLog);
        },
    };
    //console.log(vm.users);
    vm.deleteArticle = function(id) {
        let info = {
            id: id,
            action: "delete"
        }
        vm.msg = "<img src='./img/default.gif'>";
        Articles.remove(info, function(data) {
            vm.msg = "";
            console.log(data);
            vm.getAll();
        });
    }
}
