<?php ?>

<div class="product-wrapper">
    <div class="product-item">
        <h2><?=$name?></h2>
        <a href="/?c=product&a=card&id=<?=$id?>"><img src="/<?=$imgPath?>" alt="<?=$name?>"></a>
        <div class="prod-desc-wrapper">
            <div class="description"><?=$description?></div>
            <div class="price"><span>Цена:</span> <?=$price?> руб.</div>
            <div>
                <a class="btn addToCartBtn" data-id="<?=$id?>">Купить</a>
            </div>
        </div>
    </div>
</div>