@extends('layout-full')

@section('head')
    @parent

    <script src="/assets/javascripts/angular.min.js"></script>
    <script src="/assets/javascripts/maths/primes.js"></script>
@stop

@section('content')
    <div ng-app="primes">
        <h1>Primes &amp; Ulam Spirals</h1>

        <p>For more info on prime numbers and Ulam sprials <a href="http://www.youtube.com/watch?v=iFuR97YcSLM">watch this
            video</a> or <a href="http://www.youtube.com/watch?v=3K-12i0jclM">this video</a> by
            <a href="http://www.youtube.com/numberphile">numberphile</a>.</p>

        <p>Enter a range of values to spiral from and up to, the prime numbers will be highlighted. (Be careful with
            entering a large range such as 1-100000, it could slow down your computer).</p>

        <p>&nbsp;</p>

        <div ng-controller="PrimesController">
            <div class="row">
                <div class="large-4 columns">
                    <div class="row collapse">
                        <div class="large-4 columns">
                            <span class="prefix">From:</span>
                        </div>
                        <div class="large-8 columns">
                            <input type="text" ng-model="from" ng-change="updateRange()" placeholder="enter a from value">
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="large-4 columns">
                            <span class="prefix">To:</span>
                        </div>
                        <div class="large-8 columns">
                            <input type="text" ng-model="to" ng-change="updateRange()" placeholder="enter a to value">
                        </div>
                    </div>
                    
                    <label><input type="radio" ng-model="drawType" name="draw_type" value="dots" ng-change="updateDrawType()" checked="checked"> Dots</label>
                    <label><input type="radio" ng-model="drawType" name="draw_type" value="numbers" ng-change="updateDrawType()"> Numbers</label>
                </div>
            </div>

            <canvas id="primes-canvas" class="bordered"></canvas>
        </div>
    </div>
@stop