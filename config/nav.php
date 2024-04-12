<?php

return [
    [
        'icon'  => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard',
        'title' => 'Dashboard',
        'active' => 'dashboard',
    ],
    [
        'icon'  => 'far fa-circle nav-icon',
        'route' => 'categories.index',
        'title' => 'Categories',
        'badge' => 'New',
        'active' => 'categories.*',

    ],
    [
        'icon'  => 'fas fa-box nav-icon',
        'route' => 'products.index',
        'title' => 'Books',
        'badge' => 'New',
        'active' => 'products.*',

    ],
    [
        'icon'  => 'fas fa-users nav-icon',
        'route' => 'admins.index',
        'title' => 'Admin',
        'badge' => 'New',
        'active' => 'admins.*',
    ]
    ,[
        'icon'  => 'fas fa-box nav-icon',
        'route' => 'orders.index',
        'title' => 'Order',
        'badge' => 'New',
        'active' => 'admins.*',
    ]
    ,[
        'icon'  => 'fas fa-box nav-icon',
        'route' => 'borrows.index',
        'title' => 'Borrow Requests',
        'badge' => 'New',
        'active' => 'admins.*',
    ],

];
