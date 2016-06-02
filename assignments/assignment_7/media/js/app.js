


angular.module('bookApp', [])


.factory('dataService', ['$http', function($http) {
	return {
		getBooks: getBooks,
		setRating: setRating
	}

	function getBooks(id){
		return $http.get('books.php', {params:{id: id}} ).then(booksSuccess);

		  function booksSuccess(response){
		  	return response.data;
		  }
	}

	function setRating(bookId, starLevel){
		return $http.get('setStar.php', {params:{bookId:bookId, starLevel:starLevel}} ).then(setSuccess);

		  function setSuccess(response){
		  	return response.data;
		  }
	}
}])


// main controller which gets the initial books from server
.controller('bookCntrl', ['$scope', 'dataService', function($scope, dataService) {

	$scope.booksList = {};
	getAll();

	function getAll(){
		return getBooks('all').then(function(data){
			$scope.booksList = data;
			console.log('activate the books view');
			console.log($scope.booksList);
		});
	}

	function getBooks(id){
		return dataService.getBooks(id).then(function(data){
			return data;
		});
	}

}])

// directive that handles rollover and fetches data from server for more info.
// If info were to updated on server it would udate in view.
.directive('cmGetInfo', [ 'dataService', function(dataService) {

	return {
	   restrict: 'A',
	   scope:{},
	   template: '<h3>{{booksInfo.title}}</h3>' + 
                    '<p>{{booksInfo.author}}</p>' + 
                    '<p>${{booksInfo.price}}</p>' +
                    '<p class="current">Current Rating:</p>' +
                    '<div class="rating-wrap">' +
                        '<div class="rating-mask" style="width:{{booksInfo.rating}}%;">' +
                        	'<div class="rating-inner-mask">' +
	                            '<i class="fa fa-star"></i>' +
	                            '<i class="fa fa-star"></i>' +
	                            '<i class="fa fa-star"></i>' +
	                            '<i class="fa fa-star"></i>' +
	                            '<i class="fa fa-star"></i>' +
                            '</div>' +
                        '</div>' +
                  	'</div>' +
                  	'<p class="add">Add Your Rating:</p>' +
                  	'<div class="add-rating-wrap">' +
                        '<a ng-click="updateRating(1)"><i class="fa fa-star"></i></a>' +
	                    '<a ng-click="updateRating(2)"><i class="fa fa-star"></i></a>' +
	                    '<a ng-click="updateRating(3)"><i class="fa fa-star"></i></a>' +
	                    '<a ng-click="updateRating(4)"><i class="fa fa-star"></i></a>' +
	                    '<a ng-click="updateRating(5)"><i class="fa fa-star"></i></a>' +
                  	'</div>',
	   link: function(scope, element, attrs){

	   		scope.booksInfo = {};

	   		element.on('mouseover', function(){
	   			getBook(attrs.bookId);
	   		});

	   		function getBook(id){
				return getBooks(id).then(function(data){
					scope.booksInfo = data;
					scope.percent = calculatePercent(data);
				});
			}

			function getBooks(id){
				return dataService.getBooks(id).then(function(data){
					return data;
				});
			}

			function setStars(bookId, starLevel){
				return dataService.setRating(bookId, starLevel).then(function(data){
					return data;
				});
			}

			function calculatePercent(data){
				var totalStars = Number(data.star_1) + Number(data.star_2) + Number(data.star_3) + Number(data.star_4) + Number(data.star_5);
				var star1 = data.star_1*.2;
				var star2 = data.star_2*.4;
				var star3 = data.star_3*.6;
				var star4 = data.star_4*.8;
				var star5 = data.star_5*1;
				var percent = (star1 + star2 + star3 + star4 + star5) / totalStars * 100;

				scope.booksInfo.rating = percent;

			}

			scope.updateRating = function(starVal){

				setStars(attrs.bookId, 'star_' + starVal).then(function(data){
					scope.booksInfo = data;
					scope.percent = calculatePercent(data);

				});

			}
	   }

	};

}]);




angular.element(document).ready(function(){

	angular.bootstrap(document, ['bookApp']);

});