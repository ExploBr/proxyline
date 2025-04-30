<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Page;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
    $trail->push('Proxyline', route('index'));
});

Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('Admin', route('admin.index'));
});
Breadcrumbs::for('admin.page', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Страницы', route('admin.page.index'));
});

Breadcrumbs::for('admin.page.edit', function (BreadcrumbTrail $trail, Page $firstPage) {
    $trail->parent('admin.page');
     
    $trail->push(Page::breadcrumbPageTitle($firstPage) , route('admin.page.index'));
});

Breadcrumbs::for('page.show', function (BreadcrumbTrail $trail, Page $page) {
     $trail->parent('index');
    
     $trail->push(Page::breadcrumbPageShowTitle($page) , route('index'));
});


// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});