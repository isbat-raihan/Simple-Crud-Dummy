(function(){
    var app = angular.module('pos', [ ]);

    app.controller("SearchItemCtrl", ['$scope', '$http', function($scope, $http) {
        $scope.items = [ ];
        $http.get('api/item').success(function(data) {
            $scope.items = data;
        });
        $scope.saletemp = [ ];
        $scope.itemtemp = [ ];
        $scope.newsaletemp = { };
        $http.get('api/saletemp').success(function(data, status, headers, config) {
            $scope.saletemp = data;
        });

        $http.get('api/saletemp/item').success(function(itemdata, status, headers, config) {
            $scope.itemtemp = itemdata;
        });
        $scope.addSaleTemp = function(item, newsaletemp) {
            $http.post('api/saletemp', { item_id: item.id, cost_price: item.cost_price,item_vat: item.item_vat, selling_price: item.selling_price }).
            success(function(data, status, headers, config) {
                $scope.saletemp.push(data);
                    $http.get('api/saletemp').success(function(data) {
                    $scope.saletemp = data;
                    });
            });
        }
        $scope.updateSaleTemp = function(newsaletemp) {
            
            $http.put('api/saletemp/' + newsaletemp.id, { quantity: newsaletemp.quantity,item_vat: newsaletemp.item_vat, total_cost: newsaletemp.item.cost_price * newsaletemp.quantity,
                total_selling: newsaletemp.item.selling_price * newsaletemp.quantity }).
            success(function(data, status, headers, config) {
                // $http.get('api/saletemp').success(function(data) {
                //     $scope.saletemp = data;
                // });
                });
        };
        $scope.removeSaleTemp = function(id) {
            $http.delete('api/saletemp/' + id).
            success(function(data, status, headers, config) {
                $http.get('api/saletemp').success(function(data) {
                        $scope.saletemp = data;
                        });
                });
        };
        $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(newsaletemp){
                total+= parseFloat(newsaletemp.selling_price * newsaletemp.quantity);
            });
            return total;
        };

        $scope.myFunc = function() {
            $http.post('api/saletemp/item',{item_id:$scope.item_id1})
                .success(function(itemtemp, status, headers, config) {
                    $http.get('api/saletemp/item').then(function(res,status,xhr) {
                        $scope.itemtemp = res.data;
                        $scope.item_id1 = itemtemp.id;
                        $scope.quantity1 = 1;
                        $scope.cost_price1 = parseFloat(itemtemp.cost_price);
                        $scope.selling_price1 = parseFloat(itemtemp.selling_price);
                        $scope.total_cost1 = parseFloat(itemtemp.cost_price);
                    });
            });
        }

        $scope.addNew = function() {
            // var data = ({item_id: $scope.item_id1,cost_price: $scope.cost_price1,selling_price: $scope.selling_price1,total_cost: $scope.total_cost1,
            //     quantity: $scope.quantity1});
            // console.log($scope.cost_price1);
            // $http.post('api/saletemp', data)

            $http.post('api/saletemp', { item_id: $scope.item_id1, cost_price: $scope.cost_price1, selling_price: $scope.selling_price1,total_cost: $scope.total_cost1,quantity: $scope.quantity1 })
                .then(function(data, status, headers, config) {
                $scope.saletemp.push(data);
                $http.get('api/saletemp').success(function(data) {
                    $scope.saletemp = data;
                        $scope.item_id1 = '';
                        $scope.quantity1 = '';
                        $scope.cost_price1 = '';
                        $scope.selling_price1 = '';
                        $scope.total_cost1 = '';
                }
            , function(response) {
                    // Second function handles error
                    $scope.content = "Something went wrong";
                });
            });
        };

        $scope.vatCal = function(amt) {
            var datab = 0;
            var now = 0;
            var vat=0;
            if ($scope.vat += null){
                 vat = parseFloat($scope.vat);
            } else{
                 vat = 0 ;
            }
            now += ((amt/100)*vat+amt).toFixed(2);
            // now += parseFloat((((vat/amt)*100)*amt)).toFixed(2);
            return now;

            // if($scope.vat !== undefined)
            // console.log(datab);
        };


        // $scope.itemVatCal = function(newsaletemp) {
        //     var amt = $('#itemtotal').val();
        //     // var amt = $scope.newsaletemp.item.selling_price * $scope.newsaletemp.quantity
        //     var now = 0;
        //     var itemvat=0;
        //     if ($scope.newsaletemp.item_vat += null){
        //         itemvat = parseFloat($scope.item_vat);
        //     } else{
        //         itemvat = 0 ;
        //     }
        //     now += parseFloat((((itemvat/amt)*100)*amt)+amt).toFixed(2);
        //     // console.log(rate);
        //     $scope.totalvat = now;
        //     $scope.updateSaleTemp(newsaletemp);
        //
        // };

        $scope.checkVat = function()  {
            if($scope.vat > 99){
                alert('Vat cannot be greater then 100.');
                $scope.vat = null;
            }
        }

        $scope.checkDiscount = function()  {

            var item = $('#total').val();
            if($scope.discount > parseInt(item)){
                alert('Discount cannot be greater then total.');
                $scope.discount = null;
            }
        }

        $scope.checkPayment = function()  {

            var item = $('#total').val();
            if($scope.add_payment > parseInt(item)){
                alert('Discount cannot be greater then total.');
                $scope.add_payment = null;
            }
        }




    }]);
})();
