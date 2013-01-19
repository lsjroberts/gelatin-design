<h1>Ares Framework</h1>

<p><small>Source - <a href="https://bitbucket.org/gelatindesign/ares">https://bitbucket.org/gelatindesign/ares</a></small><br>
	<small>Status - Alpha</small></p>

<p>Ares is a medium-sized php framework. It is for those projects that don't require the full power of something like Symfony,
but could do with some routing and MVC. This site is running on it.</p>

<pre>Note: This is not yet actually production ready</pre>

<h2>Installation</h2>

<h3>Ares Standard</h3>

<p>Ares Standard is a quick way to get setup to use an Ares project. It provides you with the default configuration
	files and example <code>Pages</code> &amp; <code>Blog</code> modules.</p>

<p>You can clone the repository using <a href="http://git-scm.com/">Git</a> like so:</p>

<pre>
$ git clone https://bitbucket.org/gelatindesign/ares-standard.git
</pre>


<h3>Using Composer</h3>

<p>You'll now need to update your dependancies to get Ares running.</p>

<p>Make sure you have installed <a href="http://www.getcomposer.org">Composer</a>, then run:</p>

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

<p>Ares runs on two different configuration files, a global config and an environment config. This allows you to specify
	a different database connection for your development and production servers.</p>

<p>Firstly, edit <code>config/config.yml</code> to define your environments, paths and routes.</p>


<h3>Environments</h3>

<p>Your environments are matched against anything in the path/url to your site, e.g:</p>

<pre class="brush: plain">
environment:
  development: %localhost%
  production: %yoursite.co.uk%
</pre>


<h3>Paths</h3>

<p>You can change the default paths to your <code>controllers</code>, <code>models</code>, <code>templates</code>,
	<code>views</code> &amp; <code>partials</code> if you wish. For example:</p>

<pre class="brush: plain">
path:
  controllers: src/
  models: src/
</pre>

<h3>Routing</h3>

<p>You'll need to setup routes to your controllers, these direct urls to a controller and method:</p>

<pre class="brush: plain">
routes:
  Blog:
    list: blog/
</pre>

<p>You can use pattern matching to group types of urls to the same method:</p>

<pre class="brush: plain">
routes:
  Blog:
    list: blog/?:number?/?
    article: blog/:string/?
</pre>

<p>This will match <code>blog</code> or <code>blog/2</code> to the list method, displaying the first and second pages of
	articles. Individual articles will be visible on <code>blog/an-article</code> or <code>blog/another-article/</code>.</p>


<h2>MVC</h2>

<p>Ares is based on an MVC (Model-View-Controller) structure.</p>


<h3>Models</h3>

<p>A <code>model</code> contains the business logic, it stores and manipulates data from a row in a table.</p>

<p>It is responsible for maintaining the state between HTTP requests, and incorporates all the rules and behaviour for
	working with the data.</p>

<p>A blog article model might look like this:</p>

<pre class="brush: php">
class Article extends Ares\Model {
	
	public $title;
	public $slug;
	public $content;

}
</pre>

<p>An article can also have comments, a one-to-many relationship:</p>

<pre class="brush: php">
function comments() {
	return $this->hasMany('Comment');
}
</pre>

<p>And the comment model:</p>

<pre class="brush: php">
class Comment extends Ares\Model {
	
	public $user;
	public $message;

	public function article() {
		return $this->belongsTo('Article');
	}

}
</pre>


<h3>Controllers</h3>

<p>The <code>controller</code> acts as the interface between the user's request and the model's logic.</p>

<p>Each controller method is prefixed by a request type; <code>get</code> or <code>post</code>. To match all requests
	you can use <code>request</code>. Additionally, you can match for specific file types by suffixing the method with
	<code>AsXML</code> or <code>AsJSON</code> to get an rss feed for example.</p>

<pre class="brush: php">
class BlogFront extends Ares\FrontController {
	
	function getList($page = 1) {
		$per_page = 5;
		$articles = Article::findLatest($page, $per_page);
		Ares\View::render(compact('articles'));
	}

	function getListAsXML($page = 1) {
		$per_page = 20;
		$articles = Article::findLatest($page, $per_page);
		Ares\View::render(compact('articles'));
	}

	function getArticle($slug) {
		$article = Article::find()->where('slug', $slug);
		Ares\View::render(compact('article'));
	}

}
</pre>


<h3>Views</h3>

