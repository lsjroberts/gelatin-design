<p>I believe one of the main contributing factors to people being wary of using the terminal is the terrible defaults for text and colours. The good news is that these are pretty easy to fix.</p>

<p>After going through the following changes you'll end up with a lovely terminal like this:</p>

<p><img src="{{ url('/build/images/blog/2014-05-15/lovely-terminal.png') }}"></p>

<h2>Oh my zshell!</h2>

<p>{{ link_to('https://github.com/robbyrussell/oh-my-zsh', 'oh-my-zsh') }} is a must-have tool for frequent terminal users. It makes it easy to use themes for styling, but provides so much more functionality than that.</p>

<p>If you trust the author of that tool then you can install it by just running <code>curl -L http://install.ohmyz.sh | sh</code>. That'll set up the default config at <code>~/.zshrc</code>.</p>

<p>If you want to you can install it manually, check that out at the {{ link_to('https://github.com/robbyrussell/oh-my-zsh', 'github repo') }}.</p>


<h3>Pick a theme</h3>

<p>I personally use the <code>ys</code> theme, it presents your current directory, git branch and status and the current type before each command you type. This lets you see at a glance what's going on and when you fired a long running command allowing you to see how long it's taking.</p>

<p><img src="{{ url('/build/images/blog/2014-05-15/ys-line-header.png') }}"></p>

<p>To install your theme of choice, change your <code>~/.zshrc</code> to include <code>ZSH_THEME=ys</code>.</p>


<h2>Fonts and colours</h2>

<p>In addition to your theme you should set your default text font and colour and your terminal background colour. You can do this quite easily within the terminal preferences by going to <code>Terminal > Preferences...</code> and change the options under <code>Text</code> and <code>Window</code>.</p>

<p>Picking a font is pretty important, it has to be monospaced and some good choices are Monaco, Source Code Pro, Inconsolata. I personally use Iconsolata.</p>

<p>Secondly you really should think about setting the font size to something nice and large, I go with 18px. You will be staring at your terminal for a long time, don't break your eyes to do it.</p>

<p>It's worth nothing, that while background transparency might look cool, it will definitely hinder your ability to focus and work, so please just set it to 100% opacity.</p>

<p>Finally, I personally like to add extra space between lines, I find it really helps reading, so I set line spacing to <code>1.5</code> and character spacing to <code>1.05</code>. But this will depend on your personal tastes and the font you chose.</p>


<h2>The terminal is the best place for a developer to develop</h2>

<p>So much of development requires running a command-line tool here and there that you may as well just stay in the terminal the whole time. Don't use a gui program to manage your git repos, they are all slower than just running the git commands yourself. It takes time to learn but once you've learnt it you'll gain that back in time saved getting things done.</p>

<p>With that in mind I've been looking to get away from my final non-terminal based development tool, the text editor (Sublime Text 2 in my case). I've been learning vim, indeed I wrote this article with vim. It's fantastic. If you are interested in learning vim, run <code>vimtutor</code> and go through it's lessons every day and you'll soon get the hang of this powerful tool.</p>

<p>Once I'm comfortable using vim I'll write up a tutorial on customising it, though it might take a few weeks to get to that stage.</p>
