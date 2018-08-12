<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php
        $route = Yii::$app->controller->getRoute();
        echo dmstr\widgets\Menu::widget(
            [
                'activateParents' => true,
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id, null, function($menu) use ($route){
	$data = json_decode($menu['data'], true);
	$item = [
		'label'   => $menu['name'],
		'icon'    => isset($data['icon']) ? $data['icon'] : '',
		'url'     => mdm\admin\components\MenuHelper::parseRoute($menu['route']),
		'options' => (array) $data,
		'items'   => $menu['children'],
	];
    if($menu['children'] && is_array($item['url']) && isset($item['url'][0])){
        if(stripos($route, trim($item['url'][0], "/*")) === 0){
           $item['active'] = true; 
        }
    }
    return $item;
}) 
            ]
        ) ?>

    </section>

</aside>
