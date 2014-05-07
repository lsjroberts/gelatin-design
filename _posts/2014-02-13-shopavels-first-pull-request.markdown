---
layout: post
title: "Shopavel's first pull request"
date: 2014-02-13
categories: shopavel, php
---
Today I received my first [pull-request](https://github.com/shopavel/shopavel/pull/8) from another developer for one of my open source projects. How exciting.

Admitedly it is a tiny change, just one small new method, but it's still pretty cool.

It will allow you to apply a presenter to a collection of models:

{% highlight php %}
<?php

public function index()
{
    $products = $this->product->all()->each(function($product) {
            return $this->presenter->newInstance($product);
    });

    return $this->theme->make('product.index')->withProducts($products);
}
{% endhighlight %}

I have set March 31st as the deadline for [alpha1](https://github.com/shopavel/shopavel/issues?milestone=1&state=open) of Shopavel, so hopefully I'll have something good to show for it then. The alpha will include the first versions of the core framework, products, categories and themes.