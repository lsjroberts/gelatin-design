<h1>Ares Framework</h1>

<p><small>Source - <a href="https://bitbucket.org/gelatindesign/ares">https://bitbucket.org/gelatindesign/ares</a></small></p>

<p>Ares is a medium-sized php framework. It is for those projects that don't require the full power of something like Symfony,
but could do with some routing and MVC. This site is running on it.</p>


<h2>Installation</h2>

<h3>Ares Standard</h3>

<p>Ares Standard is a quick way to get setup to use an Ares project. It provides you with the default configuration
	files and an example <code>Pages</code> module.</p>

<p>You can clone the repository like so:</p>

<pre>
$ git clone https://bitbucket.org/gelatindesign/ares-standard.git
</pre>


<h3>Using Composer</h3>

<p>You'll now need to update your dependancies to get Ares running.</p>

<p>Make sure you have installed <a href="http://www.getcomposer.org">Composer</a> then run:</p>

<pre>$ composer update</pre>

<p>and you are ready to go.</p>

<p>If you want to add Ares to your own project from scratch, add it to your <code>composer.json</code> file:</p>

<pre class="brush: js;">
{
	"require": {
		"gelatindesign/ares": "1.*"
	}
}
</pre>


<h2>Configuration</h2>

<p>