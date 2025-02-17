<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class filters extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    $products = Product::orderBy('product_name')->get();
    return view('components.filters', compact('products'));
  }
}
