<form role="search" method="get" class="search-form">
    <button type="submit" class="search-form__btn">
        <svg fill="red" width="21" height="24">
            <use xlink:href="<?= getSvgSpriteUrl() ?>#search" />
        </svg>
    </button>
    <input type="search" class="search-form__input" placeholder="Search" value="" name="s" autocomplete="off"/>
</form>