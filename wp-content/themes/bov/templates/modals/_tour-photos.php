<?php
/**
 * @var array $args
 */
$introduction = $args['introduction'];
?>

<div class="modal-tour-photos modal micromodal-slide" id="modal-tour-photos" aria-hidden="true">
    <div class="modal-tour-photos__overlay modal__overlay" tabindex="-1" data-micromodal-close>
        <div role="dialog" aria-modal="true">
            <div class="modal-tour-photos__container modal__container">
                <div class="introduction__swiper-wrap-modal">
                    <div class="introduction__swiper-modal swiper">
                        <div class="introduction__swiper-wrapper swiper-wrapper">
                            <?php foreach ($introduction['slides_image'] as $slide) { ?>
                                <div class="introduction__swiper-slide introduction__swiper-slide-modal swiper-slide">
                                    <?= wp_get_attachment_image_lazy($slide, 'large_1920', 'img') ?>
                                    <span class="introduction__caption"><?= wp_get_attachment_caption($slide) ?></span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="introduction__swiper-row-nav introduction__swiper-row-nav-modal">
                        <div class="introduction__swiper-nav introduction__swiper-nav-modal--prev swiper-button-prev">
                            <svg width="24" height="24">
                                <use xlink:href="<?= getSvgSpriteUrl() ?>#swiper-left-arrow"/>
                            </svg>
                        </div>
                        <div class="introduction__swiper-pagination-modal swiper-pagination"></div>
                        <div class="introduction__swiper-nav introduction__swiper-nav-modal--next swiper-button-next">
                            <svg width="24" height="24">
                                <use xlink:href="<?= getSvgSpriteUrl() ?>#swiper-right-arrow"/>
                            </svg>
                        </div>
                    </div>
                    <button class="modal-tour-photos__close modal__close" aria-label="Close modal" data-micromodal-close>
                        <svg>
                            <use xlink:href="<?= getSvgSpriteUrl() ?>#close"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>