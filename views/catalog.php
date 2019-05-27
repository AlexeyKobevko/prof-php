<h1>Каталог</h1>

<div class="catalog">
    <?foreach ($products as $product):?>
    <div class="product-wrapper">
        <div class="product-item">
            <h2><?=$product['name']?></h2>
            <a href="/?c=product&a=card&id=<?=$product['id']?>"><img src="/<?=$product['imgPath']?>"
                                                                     alt="<?=$product['name']?>"></a>
            <div class="prod-desc-wrapper">
                <div class="description"><?=$product['description']?></div>
                <div class="price"><span>Цена:</span> <?=$product['price']?> руб.</div>
                <div>
                    <a class="btn addToCartBtn" data-id="<?=$product['id']?>">Купить</a>
                </div>
            </div>
        </div>
    </div>
    <?endforeach;?>
</div>

<a href="?c=product&a=catalog&page=<?=$page?>">Еще</a>

