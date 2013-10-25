@extends('layout')

@section('content')
    <h1>Shopavel</h1>

    <aside>
        <small>Version: <strong>dev-0.1.0</strong></small><br>
        <small>Status: Early development, unstable, everything can and likely will change.</small><br>
        <small>Code: <a href="https://github.com/shopavel/">https://github.com/shopavel</a></small>
    </aside>

    <p><strong>Shopavel is an ecommerce platform for developers.</strong> Built upon
        <a href="http://www.laravel.com">Laravel 4</a>, it aims to provide a solid platform on which to develop any
        ecommerce site selling physical or digital goods.</p>

    <p>Shopavel is designed to be flexible to fit your business's needs. All shops have <a href="#products">products</a>,
        but not all have <a href="#features">features and variations</a>, or <a href="#stock">stock</a>, or
        <a href="#warehouses">multiple warehouses</a>. Shopavel can fit all these situations.</p>

    <p>It comes with a full CMS for managing all aspects of your shop, products, customers and orders.</p>

    <blockquote>
        <p><strong>Note:</strong> This documentation is temporary and will be expanded upon and available separately at
            <a href="http://shopavel.org">http://shopavel.org</a>.</p>
    </blockquote>


    <h6>Contents</h6>

    <ul>
        <li><a href="#themes">Themes</a></li>
        <li><a href="#loops">Loops</a></li>
        <li><a href="#products">Products</a></li>
        <li><a href="#categories">Categories</a></li>
        <li><a href="#features">Features &amp; Variations</a></li>
        <li><a href="#stock">Stock</a></li>
        <li><a href="#warehouses">Warehouses</a></li>
        <li><a href="#customers">Customers</a></li>
        <li><a href="#cart">Cart</a></li>
        <li><a href="#extending">Extending Packages</a></li>
    </ul>

    <h3 id="themes">Themes <small class="pull-right"><a href="#top">top</a></small></h3>

    <p>You can completely customise the entire front-end of your site easily by creating your own theme. New themes can
        be dropped in to instantly change the look of your site.</p>

    <blockquote>
        <p><strong>Note:</strong> In the future there will be an open collection of these online with a mixture of free
            and premium designs.</p>
    </blockquote>

    <p>You can switch theme in your main shopavel config:</p>

    <pre class="filename">/app/config/packages/shopavel/shopavel/config.php</pre>
    <pre class="prettyprint">
return array(
    ...
    'theme' => 'my-theme'
    ...
);</pre>


    <h5>Basic Theme Directory Structure</h5>

    <pre class="filename">/public/themes/my-theme</pre>
    <pre class="prettyprint">
/assets
    /images
    /javascripts
    /stylesheets
/views
    /category
    /product
    etc...</pre>



    <h3 id="loops">Loops <small class="pull-right"><a href="#top">top</a></small></h3>

    <p>There are several types of loops added to the blade templating engine by shopavel. These are called using one of
        the <code>@loop_*()</code> methods, for example:</p>

    <pre class="prettyprint"><?php echo preencode('
@loop_examples()
    <h3>{b $example->title b}<h3>
@end_loop()'); ?></pre>

    <p>The default loops available are:</p>
    <pre class="prettyprint">
@loop_products()
@loop_categories()
@loop_variations()
@loop_features()
@loop_stock()
@loop_warehouses()</pre>

    <p>Additionally you can pass through options to the methods to allow customisation of the query using
        <code>@loop_examples(['option' => 'value'])</code>. Each type of loop may have it's own options available, but
        they all share these defaults:</p>

    <pre class="prettyprint">
[
    'order' => 'id|created|random',
    'take'  => '#'
]</pre>


    <h5>Extending Loop Handlers</h5>

    <p>You can extend a loop handler with new options by using the <code>Loop::extend($looper, $option, $callback)</code>
        method, as below:</p>

    <pre class="prettyprint"><?php echo preencode('
use Illuminate\Database\Eloquent\Builder;

/**
 * Add \'title\' as a choice on \'order\'
 * @loop_products([\'order\' => \'title\'])
 */
Loop::extend(\'products\', \'order\', function(Builder $query, $value)
{
    if ($value == \'title\')
    {
        $query->orderBy(\'title\', \'asc\');
    }
});

/**
 * Create a new option \'only-jelly\'
 * @loop_products([\'only-jelly\' => true])
 */
Loop::extend(\'products\', \'only-jelly\', function(Builder $query, $value)
{
    if ($value === true)
    {
        $query->where(\'title\', \'like\', \'%jelly%\')
    }
});'); ?></pre>

    <p>You can even create a new type of loop using <code>Loop::create($looper, $model)</code>:</p>

    <pre class="prettyprint"><?php echo preencode('
use Illuminate\Database\Eloquent\Builder;

Loop::create(\'authors\', \'Author\');
Loop::extend(\'authors\', \'book-category\', function(Builder $query, $value)
{
    $query->with(\'book.category\' => function($with) use ($value)
    {
        $with->where(\'title\', \'=\', $value);
    });
});
'); ?></pre>

    <pre class="prettyprint"><?php echo preencode('
{b-- List authors who have written thrillers --b}
@loop_authors([\'book-category\' => \'Thriller\'])
    {b $author->name b}
@end_loop()
'); ?></pre>



    <h3 id="products">Products <small class="pull-right"><a href="#top">top</a></small></h3>

    <p>A product can represent any physical or digital good you wish to sell.</p>

    <h5>Creating Views</h5>

    <p>If you are using the blade templating engine, the <code>@loop_products()</code> method is made available to you.</p>

    <pre class="filename">/public/themes/my-theme/views/product/index.blade.php</pre>
    <pre class="prettyprint"><?php echo preencode('
<div class="product-list">
    @loop_products()
        <article>
            <h3>{b $product->title b}</h3>
            <img src="{b $product->image b}">
        </article>
    @end_loop()
</div>') ?></pre>

    <p>You can customise which products are queried by passing options through to <code>@loop_products($options)</code>.</p>

    <p>In addition to the standard loop options, these are available:</p>

    <pre class="prettyprint">
[
    'order' => 'lastest|bestselling'
]
</pre>

    <p>If you prefer standard php, you can use <code>Product::all()</code> to retrieve the products:</p>

    <pre class="filename">/public/themes/my-theme/views/product/index.php</pre>
    <pre class="prettyprint"><?php echo preencode('
<div class="product-list">
    <?php foreach (Product::all() as $product) { ?>
        <article>
            <h3><?php echo $product->title; ?></h3>
            <img src="<?php echo $product->image; ?>">
        </article>
    <?php } ?>
</div>') ?></pre>


    <h3 id="categories">Categories <small class="pull-right"><a href="#top">top</a></small></h3>

    <p>Categories allow you to group related products. A single product can be in multiple categories, and categories
        can be nested as many levels down as you need.</p>

    <pre class="filename">/app/config/packages/shopavel/shopavel/config.php</pre>
    <pre class="prettyprint">
return array(
    ...
    'categories' => 'on' // 'on' or 'off'
    ...
);</pre>


    <h5>Creating Views</h5>

    <p>As with products, in blade templates you can use the <code>@loop_categories()</code> method to list all
        categories.</p>

    <p>Since <code>@loop_products()</code> is situationally aware, it can be called within the category loop to list all
        products within the current category.</p>

    <pre class="filename">/public/themes/my-theme/views/category/index.blade.php</pre>
    <pre class="prettyprint"><?php echo preencode('
<div class="category-list">
    @loop_categories()
        <article class="category">
            <h3>{b $category->title b}</h3>

            <section class="product-list">
                @loop_products()
                    <article class="product">
                        <h4>{b $product->title b}</h4>
                        <img src="{b $product->image b}">
                    </article>
                @end_loop()
            </section>
        </article>
    @end_loop()
</div>') ?></pre>


    <p>Again, if you prefer standard php you can use <code>Category::all()</code> and <code>$category->products</code>
        to acheive the same result.</p>



    <h3 id="features">Features &amp; Variations <small class="pull-right"><a href="#top">top</a></small></h3>

    <p>Product features can be anything like <em>colour</em>, <em>tshirt size</em>, <em>print dimensions</em> etc.</p>

    <pre class="filename">/app/config/packages/shopavel/shopavel/config.php</pre>
    <pre class="prettyprint">
return array(
    ...
    'variations' => 'on' // 'on' or 'off'
    ...
);</pre>

    <p>Each product can have variations made up of combinations of options within these features. For example, a tshirt
        might have the following variations:</p>

    <pre class="prettyprint">
Variation A
    Colour: Red
    Size: Medium

Variation B
    Colour: Red
    Size: Large

Variation C
    Colour: Black
    Size: Medium</pre>

    <p>When viewing the product the customer will have the opportunity to select their prefered options or variation.</p>


    <h5>Creating Views</h5>

    <p>You can choose to either show the customer a list of variations with a 'Buy Now' button next to each one, or
        present them with feature options to choose from.</p>

    <h6>Listing Variations</h6>

    <pre class="filename">/public/themes/my-theme/views/product/show.blade.php</pre>
    <pre class="prettyprint"><?php echo preencode('
<article class="product">
    <h1>{b $product->title; b}</h1>

    <section class="variations">
        @loop_variations()
            <div class="variation">
                <p>{b $variation->title b}</p>
                <a href="{b URL::route(\'basket-add-variation\', [
                    \'product\' => $product,
                    \'variation\' => $variation
                ]) b}">Buy Now</a>
            </div>
        @end_loop()
    </section>
</div>') ?></pre>


    <h6>Listing Features &amp; Options</h6>

    <pre class="filename">/public/themes/my-theme/views/product/show.blade.php</pre>
    <pre class="prettyprint"><?php echo preencode('
<form action="{b URL::route(\'basket-add\', [\'product\' => $product]) b}">
    <article class="product">
        <h1>{b $product->title; b}</h1>

        <section class="features">
            @loop_display_features()
                <div class="feature">
                    <label>{b $feature->title b}</label>
                    <p>{b $feature->option->title b}</label>
                </div>
            @end_loop()

            @loop_choice_features()
                <div class="feature">
                    <label>{b $feature->title b}</label>

                    <select name="feature[{b $feature->id b}]">
                        @loop_options()
                            <option value="{b $option->id b}">{b $option->title b}</option>
                        @end_loop()
                    </select>
                </div>
            @end_loop()

            <button type="submit">Buy Now</a>
        </section>
    </div>
</form>') ?></pre>



    <h3 id="stock">Stock <small class="pull-right"><a href="#top">top</a></small></h3>

    <p>There are multiple ways you can keep track of your stock:</p>

    <ul>
        <li>A basic <em>in</em> / <em>out</em> toggle,</li>
        <li>A single <em>stock count</em> for each variation,</li>
        <li>Or insert new <em>purchase orders</em> into the system keeping track of each separate batch of stock.</li>
    </ul>

    <p>Your preference can be set in the main shopavel config. You can turn stock tracking off if it is not needed,
        e.g. digital goods.</p>

    <pre class="filename">/app/config/packages/shopavel/shopavel/config.php</pre>
    <pre class="prettyprint">
return array(
    ...
    'stock' => 'basic' // 'off', 'basic', 'count' or 'batch'
    ...
);</pre>



    <h3 id="warehouses">Warehouses <small class="pull-right"><a href="#top">top</a></small></h3>

    <p>If you have multiple warehouses that you ship your products from, you can include them using the warehouses
        package.</p>

    <p>Stock can be assigned to a warehouse to help with tracking it's location. This gives you the option to restrict
        a product to only local customers (by any geographical attribute) and send notifications to staff at the
        specific warehouse when a product is purchased.</p>

    <pre class="filename">/app/config/packages/shopavel/shopavel/config.php</pre>
    <pre class="prettyprint">
return array(
    ...
    'warehouses' => 'on' // 'on' or 'off'
    ...
);</pre>



    <h3 id="customers">Customers <small class="pull-right"><a href="#top">top</a></small></h3>

    <p>The customers package is flexible to you and your users needs.</p>

    <ul>
        <li>Purchasing an order as a <em>guest</em> with no registration required,</li>
        <li>Variety of options for <em>account management</em>,</li>
    </ul>

    <pre class="filename">/app/config/packages/shopavel/shopavel/config.php</pre>
    <pre class="prettyprint">
return array(
    ...
    'allow_guest_purchases' => 'yes' // 'yes' or 'no',
    'customers' => array(
        ''
    )
    ...
);</pre>



    <h3 id="cart">Cart <small class="pull-right"><a href="#top">top</a></small></h3>

    <p></p>


    <h3 id="extending">Extending Packages <small class="pull-right"><a href="#top">top</a></small></h3>

    <p>All of the above packages are extendable, allowing you to customise the behaviour of your shop.</p>

    <pre class="prettyprint">
some example of how to do this</pre>
@stop