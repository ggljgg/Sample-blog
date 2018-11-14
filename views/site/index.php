<?php
use yii\widgets\LinkPager;
?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($articles as $article): ?>
                    <article class="post">
                        <div class="post-thumb">
                            <a href="blog.html"><img src="<?= $article->getImage(); ?>" alt=""></a>

                            <a href="blog.html" class="post-thumb-overlay text-center">
                                <div class="text-uppercase text-center">View Post</div>
                            </a>
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h6><a href="#"><?= $article->category->getTitle(); ?></a></h6>

                                <h1 class="entry-title"><a href="blog.html"><?= $article->getTitle(); ?></a></h1>


                            </header>
                            <div class="entry-content">
                                <p><?= $article->getDescription(); ?></p>

                                <div class="btn-continue-reading text-center text-uppercase">
                                    <a href="blog.html" class="more-link">Continue Reading</a>
                                </div>
                            </div>
                            <div class="social-share">
                                <span class="social-share-title pull-left text-capitalize">
                                    By <a href="#">Rubel</a> On <?= $article->getDate(); ?>
                                </span>
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int) $article->getViewed(); ?>
                                </ul>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

                <?php    
                    // отображаем ссылки на страницы
                    echo LinkPager::widget([
                        'pagination' => $pagination,
                    ]);
                ?>
            </div>
            <div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">
                    
                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
                        <?php foreach($popularArticles as $popularArticle): ?>
                            <div class="popular-post">
                                <a href="#" class="popular-img"><img src="<?= $popularArticle->getImage(); ?>" alt="">
                                    <div class="p-overlay"></div>
                                </a>
                                <div class="p-content">
                                    <a href="#" class="text-uppercase"><?= $popularArticle->getTitle(); ?></a>
                                    <span class="p-date"><?= $popularArticle->getDate(); ?></span>
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
                                        <a href="#" class="popular-img"><img src="<?= $recentArticle->getImage(); ?>" alt="">
                                            <div class="p-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="p-content">
                                        <a href="#" class="text-uppercase"><?= $recentArticle->getTitle(); ?></a>
                                        <span class="p-date"><?= $recentArticle->getDate(); ?></span>
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
                                    <a href="#"><?= $articleCategory->getTitle(); ?></a>
                                    <span class="post-count pull-right"> (<?= $articleCategory->getArticlesCount(); ?>)</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>