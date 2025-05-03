<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Page;
use App\Models\PageLangs;
use App\Models\Post;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
 
Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
    $trail->push('Proxyline', route('index'));
});
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $instruction = Page::where('template','=','instruction')->value('id');
    $instruction_slug = Page::where('template','=','instruction')->value('slug');
    $instruction_main = PageLangs::where('page_id', '=', $instruction)->value('title');
    $trail->push( $instruction_main , route('page.show',  $instruction_slug));
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

Breadcrumbs::for('post.show', function (BreadcrumbTrail $trail, Post $page) {
     $trail->parent('index');
     $trail->parent('blog');
    
     $trail->push($page->title , route('index'));
});


 