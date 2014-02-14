<p>Today I received my first {{ link_to('https://github.com/shopavel/shopavel/pull/8', 'pull-request') }} from another developer for one of my open source projects. How exciting.</p>

<p>Admitedly it is a tiny change, just one small new method, but it's still pretty cool.</p>

<p>It will allow you to apply a presenter to a collection of models:</p>

<pre>
public function index()
{
    $products = $this->product->all()->each(function($product) {
            return $this->presenter->newInstance($product);
    });

    return $this->theme->make('product.index')->withProducts($products);
}
</pre>

<p>I have set March 31st as the deadline for {{ link_to('https://github.com/shopavel/shopavel/issues?milestone=1&state=open', 'alpha1') }} of Shopavel, so hopefully I'll have something good to show for it then. The alpha will include the first versions of the core framework, products, categories and themes.</p>