var primes = angular.module('primes', []);

primes.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

primes.controller('PrimesController', ['$scope', function($scope) {
    var canvas, context, width, height, centerX, centerY, spacing, radius;

    $scope.data = [];
    $scope.drawType = 'dots';

    canvas = document.getElementById('primes-canvas');
    context = canvas.getContext('2d');

    width = canvas.offsetWidth;
    height = canvas.offsetHeight;
    centerX = Math.floor(width / 2);
    centerY = Math.floor(height / 2);

    spacing = 30;
    radius = 4;

    $scope.updateRange = function() {
        $scope.from = parseInt($scope.from);
        $scope.to = parseInt($scope.to);

        if ($scope.from > 0 && $scope.to > $scope.from) {
            generateSpiral($scope.from, $scope.to);
        }
    };

    $scope.updateDrawType = function()
    {
        generateSpiral($scope.from, $scope.to);
    }

    /**
     * The side lengths of the spiral follow the pattern 1,1,2,2,3,3,4,4,....,n,n
     * 
     * @param  {int} from
     * @param  {int} to
     * @return {void}
     */
    function generateSpiral(from, to, highlight) {
        var x, y, dx, dy, side, sideLength, number, points;

        if ($scope.drawType == 'dots') {
            if (to > 19000) {
                spacing = 3;
                radius = 1;
            } else if (to > 4760) {
                spacing = 5;
                radius = 2;
            } else {
                spacing = 10;
                radius = 4;
            }
        } else {
            spacing = 30;
        }

        context.clearRect(0, 0, width, height);

        points = [];

        x = centerX;
        y = centerY;

        dx = 1;
        dy = 0;

        side = 1;
        sideLength = 1;

        number = from;

        if ($scope.drawType == 'dots') {
            drawDot(x, y);
        } else {
            drawNumber(x, y, number);
        }

        while (number < to) {
            for (i = 0; i < sideLength; i++) {
                number++;

                x += (dx * spacing);
                y += (dy * spacing);

                color = null;
                if (isPrime(number)) {
                    color = '#c03435';
                }

                if (number == highlight) {
                    color = '#00ff00';
                }

                if ($scope.drawType == 'dots') {
                    drawDot(x, y, color);
                } else {
                    drawNumber(x, y, number, color);
                }
            }

            // turn left
            if (dx == 1 && dy == 0) {
                dx = 0;
                dy = -1;
            } else if (dx == 0 && dy == -1) {
                dx = -1;
                dy = 0;
            } else if (dx == -1 && dy == 0) {
                dx = 0;
                dy = 1;
            } else if (dx == 0 && dy == 1) {
                dx = 1;
                dy = 0;
            }

            if (side % 2 == 0) {
                sideLength++;
            }

            side++;
        }
    }

    // http://www.javascripter.net/faq/numberisprime.htm
    function isPrime(n) {
        if (isNaN(n) || !isFinite(n) || n%1 || n<2) return false; 
        if (n==leastFactor(n)) return true;
        return false;
    }

    // http://www.javascripter.net/faq/numberisprime.htm
    function leastFactor(n) {
        if (isNaN(n) || !isFinite(n)) return NaN;
        if (n==0) return 0;
        if (n%1 || n*n<2) return 1;
        if (n%2==0) return 2;
        if (n%3==0) return 3;
        if (n%5==0) return 5;
        var m = Math.sqrt(n);
        for (var i=7;i<=m;i+=30) {
            if (n%i==0)      return i;
            if (n%(i+4)==0)  return i+4;
            if (n%(i+6)==0)  return i+6;
            if (n%(i+10)==0) return i+10;
            if (n%(i+12)==0) return i+12;
            if (n%(i+16)==0) return i+16;
            if (n%(i+22)==0) return i+22;
            if (n%(i+24)==0) return i+24;
        }
        return n;
    }

    function drawDot(x, y, color) {
        context.beginPath();
        context.arc(x - radius, y - radius, radius, 0, 2 * Math.PI, false);

        if (! color) {
            color = '#cccccc';
        }
        context.fillStyle = color;

        context.fill();
    }

    function drawNumber(x, y, number, color) {
        if (! color) {
            color = '#cccccc';
        }
        context.fillStyle = color;
        context.textAlign = 'center';
        context.textBaseline = 'middle';
        context.fillText(number.toString(), x, y);
    }

    canvas.width = width;
    canvas.height = height;
}]);