<!DOCTYPE html>
<html>
	<head>
		<title>gelatindesign | a coder making websites + games</title>

		<meta charset="utf-8">

		<link href="/css/app.less" rel="stylesheet/less">

		<script src="/js/less.js"></script>
		
		<script src="/js/app.js"></script>

		<script src="/js/sh/shCore.js"></script>
		<script src="/js/sh/shAutoloader.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<section class="bar">
				<div class="red"></div>
				<div class="darkorange"></div>
				<div class="orange"></div>
				<div class="lightorange"></div>
				<div class="lighterorange"></div>
			</section>

			<section id="sidebar">
				<header>
					<h1><a href="/">gelatindesign</a></h1>
					<p>i'm a coder making websites + games</p>

					<p><small class="twitter"><a href="http://www.twitter.com/gelatindesign">@gelatindesign</a></small></p>
					<p><small class="email"><a href="mailto:info@gelatindesign.co.uk">info@gelatindesign.co.uk</a></small></p>
				</header>

				<section class="web">
					<h2>web</h2>

					<p><a href="/ares">ares framework</a></p>
					<p><a href="/whats-our-plan">what's our plan?</a></p>
					<p><a href="/data-is-cool">data is cool</a></p>
				</section>

				<section class="games">
					<h2>games</h2>

					<p><a href="/ipatw">i painted a tiny world <small>ludum dare 23</small></a></p>
					<p><a href="/neon-spores">neon spores <small>ludum dare 24</small></a></p>
				</section>
			</section>

			<section id="content">
				<? Ares\View::view(); ?>
			</section>

			<footer id="footer" class="clear">
				<p>&copy; <?=date('Y')?> gelatindesign</p>
			</footer>
		</div>
	</body>
	<script type="text/javascript">
		function path()
		{
			var args = arguments,
				result = []
				;
				
			for(var i = 0; i < args.length; i++)
				result.push(args[i].replace('@', '/js/sh/'));
				
			return result
		};

		SyntaxHighlighter.autoloader.apply(null, path(
			'applescript			@shBrushAppleScript.js',
			'actionscript3 as3		@shBrushAS3.js',
			'bash shell				@shBrushBash.js',
			'coldfusion cf			@shBrushColdFusion.js',
			'cpp c					@shBrushCpp.js',
			'c# c-sharp csharp		@shBrushCSharp.js',
			'css					@shBrushCss.js',
			'delphi pascal			@shBrushDelphi.js',
			'diff patch pas			@shBrushDiff.js',
			'erl erlang				@shBrushErlang.js',
			'groovy					@shBrushGroovy.js',
			'java					@shBrushJava.js',
			'jfx javafx				@shBrushJavaFX.js',
			'js jscript javascript	@shBrushJScript.js',
			'perl pl				@shBrushPerl.js',
			'php					@shBrushPhp.js',
			'text plain				@shBrushPlain.js',
			'py python				@shBrushPython.js',
			'powershell ps posh		@shBrushPowerShell.js',
			'ruby rails ror rb		@shBrushRuby.js',
			'sass scss				@shBrushSass.js',
			'scala					@shBrushScala.js',
			'sql					@shBrushSql.js',
			'vb vbnet				@shBrushVb.js',
			'xml xhtml xslt html	@shBrushXml.js'
		));
		SyntaxHighlighter.all();
	</script>
</html>