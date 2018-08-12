<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu ">

            <ul class="nav navbar-nav">

                <li class="dropdown notifications-menu ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">部局
                    </a>
                    <ul class="dropdown-menu" style="width: 60px">
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(['/site/layout','lang'=>'']);?>">平铺</a>
                                </li>

                                <li>
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(['/site/layout','layout'=>'layout-boxed']);?>">boxed</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="dropdown notifications-menu ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">皮肤
                    </a>
                    <ul class="dropdown-menu" style="width: 60px">
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <?php foreach (Yii::$app->params['skins'] as $skin => $style) { ?>
                                    
                                    <li>
                                        <a href="<?php echo Yii::$app->urlManager->createUrl(['/site/skin','style'=>$style]);?>"><?= $skin?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="dropdown notifications-menu ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?= Yii::$app->language == 'zh-CN' ? '中文' : 'English';?>
                    </a>
                    <ul class="dropdown-menu" style="width: 60px">
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
									<a href="<?php echo Yii::$app->urlManager->createUrl(['/site/language','lang'=>'zh-CN']);?>">中文</a>
                                </li>

                                <li>
									<a href="<?php echo Yii::$app->urlManager->createUrl(['/site/language','lang'=>'en']);?>">English</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                Alexander Pierce - Web Developer
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
