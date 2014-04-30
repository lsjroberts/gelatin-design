<p>{{ link_to('http://semver.org/', 'Semantic versioning') }} is an incredibly important concept that has allowed package management to thrive. Combined with {{ link_to('http://getcomposer.org', 'composer') }} it has helped transform PHP from a unregulated crazy world to one of order and compatibility.</p>

<p>Yet there is one major problem that I have experienced and seen in several projects. It needs a fourth number at the start, a "philosophical" or "brand" version number.</p>

@if (isset($split) and $split)
    <p><em>{{ link_to_route('blog.post', 'Continue reading "' . $article->title . '" ...', ['slug' => $article->slug]) }}</em></p>
@else

<p>A good example of this is the {{ link_to('http://laravel.com/docs/upgrade#upgrade-4.1', 'Laravel 4.0 to 4.1 update') }}. 4.1 is a backwards incompatible change, if you just update your <code>composer.json</code> to point to the new version your app will break on update. Yet Taylor Otwell rightly doesn't want to change to Laravel 5 as the brand is Laravel 4. You could say Laravel 4 is philoshophically different from Laravel 3, the involved packages have a set approach to them that differs from the previous version.</p>

<p>So really, it shouldn't be numbered as <code>4.1.0</code> but <code>4.1.0.0</code> and incrementing:</p>

<ol>
    <li>BRAND version when you made philosophical changes,</li>
    <li>MAJOR version when you make incompatible API changes,</li>
    <li>MINOR version when you add functionality in a backwards-compatible manner, and</li>
    <li>PATCH version when you make backwards-compatible bug fixes.</li>
</ol>

@endif