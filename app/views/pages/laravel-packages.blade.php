@extends('layout')

@section('content')
    <h1>Laravel Packages</h1>

    <ul>
        <li><a href="#datadog-statsd">datadog-statsd</a></li>
    </ul>

    <h3 id="datadog-statsd">datadog-statsd</h3>
    <p>
        <small>Version: <strong>0.1.1</strong></small><br>
        <small>Status: Stable, no test suite.</small><br>
        <small>Composer: <a href="http://packagist.org/packages/lsjroberts/datadog-statsd">lsjroberts/datadog-statsd</a></small><br>
        <small>Code: <a href="https://github.com/lsjroberts/datadog-statsd">https://github.com/lsjroberts/datadog-statsd</a></small><br>
        <small>Forked from: <a href="https://github.com/DataDog/php-datadogstatsd">https://github.com/DataDog/php-datadogstatsd</a></small>
    </p>

    <p><strong>datadog-statsd</strong> is a statsd client for <a href="http://datadoghq.com">DataDog</a>, although it
        could also be used in other statsd environments with some lost functionality specific to DataDog. It is a
        Laravel-ised, PSR-2 compliant version of the original package.</p>

    <blockquote>
        <p><strong>Note:</strong> Credits largely go to the original coders, I just cleaned it up and added some new
            methods.</p>
    </blockquote>


    <h5>Configuration</h5>

    <p>Set your api and application keys, found in the <a href="https://app.datadoghq.com/account/settings#api">API tab</a>
        on DataDog:</p>

    <pre class="filename">/app/config/packages/lsjroberts/datadog-statsd/config.php</pre>
    <pre class="prettyprint">
return array(
    ...
    'api_key' => 'your_api_key',
    'application_key' => 'your_application_key',
    ...
);</pre>

    <pre class="filename">/app/config/app.php</pre>
    <pre class="prettyprint">
return array(
    ...
    'providers' => array(
        ...
        'DataDog\Statsd\StatsdServiceProvider',
        ...
    ),
    ...
    'aliases' => array(
        ...
        'Statsd' => 'DataDog\Statsd\Facades\Illuminate',
        ...
    ),
    ...
);</pre>


    <h5>Increment</h5>

    <pre class="prettyprint">
Statsd::increment('your.data.point');
Statsd::increment('your.data.point', .5);
Statsd::increment('your.data.point', 1, array('tag' => 'value'));</pre>

    
    <h5>Decrement</h5>

    <pre class="prettyprint">
Statsd::decrement('your.data.point');</pre>

    
    <h5>Timing</h5>
    <pre class="prettyprint">
Statsd::startTiming('your.data.point');
someFunction();
Statsd::endTiming('your.data.point');</pre>


    <h5>Events</h5>
    <pre class="prettyprint">
Statsd::event('A thing broke!', array(
    'alert_type' => 'error',
    'aggregation_key' => 'test_aggr'
));

Statsd::event('Now it is fixed', array(
    'alert_type' => 'success',
    'aggregation_key' => 'test_aggr'
));</pre>
@stop