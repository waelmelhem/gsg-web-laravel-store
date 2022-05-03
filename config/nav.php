<?php
return  [
    'dashboard'=>[
        'title'=>'Dashboard',
        'icon'=>'far fa-circle nav-icon',
        'route.active'=>"dashboard",
        'route'=>'/dashboard'
    ],
    'categories'=>[
        'title'=>'Categories',
        'icon'=>'far fa-circle nav-icon',
        'route.active'=>"dashboard.categories.*",
        'route'=>'/dashboard/categories',
    
    ],
    'products'=>[
        'title'=>'Products',
        'icon'=>'far fa-circle nav-icon',
        'route.active'=>"dashboard.products.*",
        'route'=>'/dashboard/products'
    ],
    'orders'=>[
        'title'=>'Orders',
        'icon'=>'far fa-circle nav-icon',
        'route'=>'/dashboard/orders',
        'route.active'=>"dashboard.orders.*",
        'badge'=>[
            'title'=>'OLD',
            'style'=>'right badge badge-info'
        ]
    ],
    'setting'=>[
        'title'=>'Settings',
        'icon'=>'far fa-circle nav-icon',
        'route.active'=>"dashboard.settings.*",
        'route'=>'/dashboard/settings'
    ]

];