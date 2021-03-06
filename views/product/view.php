<?php include ROOT.'/views/layouts/header.php'?>

<section class="one-goods">
			<div class="one-goods__wrapper">

				<div class="one-goods__top">
					<a class="one-goods__link" >
						<h3 class="one-goods__title"><?php echo $viewItem['name'];?></h3>
						<img src="<?php echo /*'/template/'.$viewItem['img'];*/Product::getImage($viewItem['id']);?>" width="400" height="500" alt="Слинг">
					</a>
					<div class="one-goods__info">

						<div class="one-goods__buttons">
							<p><?php echo $viewItem['description'];?></p>
							<b>Цена <?php echo $viewItem['price']; ?> рублей</b>

                                    <?php if ($viewItem['availability'] > 0) : ?>
                                    <p class="one-goods__availability  one-goods__availability--ok">В наличии</p>
                                    <?php else : ?>
                                    <p class="one-goods__availability">Нет в наличии </p>
									<p class="one-goods__delivery">На пошив и доставку к вам этого слинга нам необходимо некоторое время<br>МЫ ДОСТАВИМ ЕГО В ВАШЕ ПОЧТОВОЕ ОТДЕЛЕНИЕ ЧЕРЕЗ ДВЕ НЕДЕЛИ  </p>
									<a class="vissual-hidden" href="https://ru.icons8.com/icon/13114/Отмена"></a>
                                    <?php endif; ?>

                            <div class="goods__buttons <?php if ($viewItem['availability'] > 0) { echo 'goods__buttons--this'; } ?>">
                                <a class="btn  goods__buttons--is  baskin" data-id="<?php echo $viewItem['id']; ?>" href="/cart/add/<?php echo $viewItem['id'];?>">В корзину</a>
								<a class="btn  goods__buttons--is  buy" data-id = "<?php echo $viewItem['id']; ?>"  href="/cart/chooseone/<?php echo $viewItem['id'];?>/buy">Купить в один клик</a>
								<!-- //<a class="btn  goods__buttons--is" href="/cart/chooseone/<?php echo $viewItem['id'];?>" >Купить</a> -->
                              <a class="btn  goods__buttons--isnt" href="/cart/chooseone/<?php echo $viewItem['id'];?>/book">Заказать</a>
							</div>
						</div>

						<div class="one-goods__items">
							<a class="one-goods__item-open" href="#"><b>Доставка</b></a>
							<ul class="one-goods__item">
								<li>Курьером по Тюмени - 250 рублей (бесплатно от 3500 рублей)</li>
								<li>Отправка почтой по России - 300 рублей (при покупке на сумму более 5000 рублей - бесплатно)</li>
								<li>Транспортной компанией по России - 350 рублей</li>
	 						</ul>
							<a class="one-goods__item-open"  href="#"><b>Шоу-рум в Тюмени</b></a>
							<ul class="one-goods__item">
								<li>Большинство слингов есть в наличии</li>
								<li>Покупка с оплатой картой и наличными</li>
							</ul>
							<a class="one-goods__item-open"  href="#"><b>Наши преимущества</b></a>
							<ul class="one-goods__item">
								<li>Бесплатная доставка</li>
								<li>Привезём несколько вариантов на выбор</li>
								<li>Возврат и обмен без проблем</li>
								<li>Бесплатная слингоконсультация</li>
							</ul>
						</div>
					</div>
				</div>
            </div>
        </section>

		<section class="advantages slider slider--nojs">

			<div class="advantages__wrapper">
				<h2 class="advantages__title  visually-hidden">Преимущества наших слингов</h2>
				<input class="slider__input" type="radio" name="advantages" value="0" id="advantages-input-1" checked>
				<input class="slider__input" type="radio" name="advantages" value="1" id="advantages-input-2">
				<input class="slider__input" type="radio" name="advantages" value="2" id="advantages-input-3">

				<ul class="advantages__items">
					<li class="advantages__item  advantages__item--quality  slider__item">
						<h3 class="advantages__item-title">Гарантия качества</h3>
						<p>Мы предлагаем только те товары в качестве которых мы уверены</p>
					</li>

					<li class="advantages__item  advantages__item--delivery  ">
						<h3 class="advantages__item-title">Быстро и качественно доставляем</h3>
						<p>Наша компания производит доставку по всей России</p>
					</li>

					<li class="advantages__item  advantages__item--return ">
						<h3 class="advantages__item-title">Возврат и обмен товара</h3>
						<p>В соответствии с законом о правах потребителей</p>
					</li>
				</ul>

				<div class="advantages__toggles  slider__toggles">
					<label class="slider__toggle" for="advantages-input-1">1</label>
					<label class="slider__toggle" for="advantages-input-2">2</label>
					<label class="slider__toggle" for="advantages-input-3">3</label>
				</div>
			</div>
			<a class="visually-hidden" href="https://ru.icons8.com/icon/44216/Вернуть-покупку">Вернуть покупку иконка в оригинале</a>
		</section>

		<script src="/template/js/advantages-slider.js"></script>


<?php include ROOT.'/views/layouts/footer.php'?>
