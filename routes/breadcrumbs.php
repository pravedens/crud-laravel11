<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Category;
use App\Models\Food;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Food
Breadcrumbs::for('food', function (BreadcrumbTrail $trail) {
    $trail->push('Food', route('foods.index'));
});

// Food > [Edit]
Breadcrumbs::for('detailfood', function (BreadcrumbTrail $trail, Food $food) {
    $trail->parent('food');
    $trail->push($food->name, route('foods.edit', $food));
});

// Category
Breadcrumbs::for('category', function (BreadcrumbTrail $trail) {
    $trail->push('Category', route('categories.index'));
});

// Category > [Edit]
Breadcrumbs::for('detailcategory', function (BreadcrumbTrail $trail, Category $category) {
    $trail->parent('category');
    $trail->push($category->name, route('categories.edit', $category));
});
