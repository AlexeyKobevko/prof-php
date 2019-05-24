<?php ?>

<h2><?=$product->name?></h2>
    <div class="product-wrapper">
        <div class="product-item">
            <img src="/<?=$product->imgPath?>" alt="<?=$product->name?>">
            <div class="prod-desc-wrapper">
                <div class="description"><?=$product->description?></div>
                <div class="price"><span>Цена:</span> <?=$product->price?> руб.</div>
                <div>
                    <a class="btn addToCartBtn" data-id="<?=$product->id?>">Купить</a>
                </div>
            </div>
        </div>
    </div>