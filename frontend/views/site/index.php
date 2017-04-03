<?php
/* @var $this yii\web\View */

$this->title = '寻想网络科技|梦想创造一切';
?>
<?= $this->render("/layouts/flashPic.php", ['this' => $this]) ?>
<?php
$this->registerCssFile("/css/index.css?v=" . date("YmdHis"));
?>
<div class="base-container filp-container margin25 clear">
    <ul>
        <li>
            <div class="out-box">
                <div class="front-box index-center-box">
                    <h1>创新</h1>
                    <img src="/images/chuangxin.gif">
                </div>
                <div class="back-box index-center-box">
                    <h1>创新</h1>
                    <p class="lead pd15">&nbsp;&nbsp;&nbsp;&nbsp;以现有的思维模式提出有别于常规或常人思路的见解为导向,利用现有的知识和物质，在特定的环境中,本着理想化需要或为满足社会需求，而改进或创造原来不存在或不完善的事物、方法、元素、路径、环境，并能获得一定有益效果的行为。</p>
                </div>
            </div>
        </li>
        <li>
            <div class="out-box">
                <div class="front-box index-center-box">
                    <h1>科技</h1>
                    <img src="/images/keji.gif">
                </div>
                <div class="back-box index-center-box">
                    <h1>科技</h1>
                    <p class="lead pd15">&nbsp;&nbsp;&nbsp;&nbsp;解决理论问题，技术解决实际问题。科学要解决的问题，是发现自然界中确凿的事实与现象之间的关系，并建立理论把事实与现象联系起来；技术的任务则是把科学的成果应用到实际问题中去。</p>
                </div>
            </div>
        </li>
        <li>
            <div class="out-box">
                <div class="front-box index-center-box">
                    <h1>平台</h1>
                    <img src="/images/pingtai.gif">
                </div>
                <div class="back-box index-center-box">
                    <h1>平台</h1>
                    <p class="lead pd15">&nbsp;&nbsp;&nbsp;&nbsp;教你不仅仅扩大自身影响，同时还要将影响力变为实际效益，并且打造成为终身职业。关键何在？就在于搭建平台。如此简单易行，如此低投入，如此的成功可能，真是前所未有。</p>
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="base-container example-container margin25 clear">
    <h1 class="text-left index-main-h1">科技方案</h1>
    <ul>
        <li>
            <div class="example-box">
                <img src="/images/example1.png"/>
                <h3>尖端机器人领域</h3>
            </div>
        </li>
        <li>
            <div class="example-box">
                <img src="/images/example2.png"/>
                <h3>智能式餐厅</h3>
            </div>
        </li>
        <li>
            <div class="example-box">
                <img src="/images/example3.png"/>
                <h3>生物智能科技</h3>
            </div>
        </li>
    </ul>
</div>
<div class="base-container news-container margin25 clear">
    <h1 class="text-left index-main-h1">业界资讯</h1>
    <ul>
        <li>
            <div class="news-box">
                <img src="/images/news1.png"/>
                <h3>IPHONE8再出红色版</h3>
            </div>
        </li>
        <li>
            <div class="news-box">
                <img src="/images/news2.png"/>
                <h3>区域链技术快速漫延</h3>
                <img src="/images/news2.png"/>
                <h3>智能式餐厅</h3>
            </div>
        </li>
        <li>
            <div class="news-box">
                <img src="/images/news2.png"/>
                <h3>智能式餐厅</h3>
                <img src="/images/news2.png"/>
                <h3>智能式餐厅</h3>
            </div>
        </li>
        <li>
            <div class="news-box">
                <img src="/images/news2.png"/>
                <h3>智能式餐厅</h3>
                <img src="/images/news2.png"/>
                <h3>智能式餐厅</h3>
            </div>
        </li>
    </ul>
</div>