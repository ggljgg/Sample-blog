<?php
use yii\helpers\Url;
?>
<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
            <?php foreach($popularArticles as $popularArticle): ?>
            <div class="popular-post">
                <a href="<?= Url::toRoute(['site/view', 'id' => $popularArticle->id]); ?>" class="popular-img"><img src="<?= $popularArticle->getImage(); ?>" alt="">
                    <div class="p-overlay"></div>
                </a>
                <div class="p-content">
                    <a href="<?= Url::toRoute(['site/view', 'id' => $popularArticle->id]); ?>" class="text-uppercase">
                        <?= $popularArticle->getTitle(); ?></a>
                    <span class="p-date">
                        <?= $popularArticle->getDate(); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </aside>
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
            <?php foreach($recentArticles as $recentArticle): ?>
            <div class="thumb-latest-posts">
                <div class="media">
                    <div class="media-left">
                        <a href="<?= Url::toRoute(['site/view', 'id' => $recentArticle->id]); ?>" class="popular-img"><img src="<?= $recentArticle->getImage(); ?>" alt="">
                            <div class="p-overlay"></div>
                        </a>
                    </div>
                    <div class="p-content">
                        <a href="<?= Url::toRoute(['site/view', 'id' => $recentArticle->id]); ?>" class="text-uppercase">
                            <?= $recentArticle->getTitle(); ?></a>
                        <span class="p-date">
                            <?= $recentArticle->getDate(); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
            <ul>
                <?php foreach ($articleCategories as $articleCategory): ?>
                <li>
                    <a href="<?= Url::toRoute(['site/category', 'id' => $articleCategory->id]); ?>">
                        <?= $articleCategory->getTitle(); ?></a>
                    <span class="post-count pull-right"> (
                        <?= $articleCategory->getArticlesCount(); ?>)</span>
                </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
</div>