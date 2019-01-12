<?php

namespace App\Store\Discount\Rule;

abstract class AbstractRule
{
}

// rule types:
// - by count of items (of group)
// - by count of items in cart
// - by cart total
// - compound rules
//  - by matching all other rules
//  - by matching any other rules