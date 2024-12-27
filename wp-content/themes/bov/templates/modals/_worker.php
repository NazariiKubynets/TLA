<?php
/**
 * @var array $args
 */

?>

<div class="modal-worker modal micromodal-slide" id="modal-worker" aria-hidden="true">
    <div class="modal-worker__overlay modal__overlay" tabindex="-1" data-micromodal-close>
        <div role="dialog" aria-modal="true">
            <div class="modal-worker__container modal__container">
                <div id="modal-worker-img" class="modal-worker__img"></div>
                <h4 id="modal-worker-name" class="modal-worker__name title-m"></h4>
                <p id="modal-worker-position" class="modal-worker__position"></p>
                <div id="modal-worker-text" class="modal-worker__text"></div>
                <button class="modal-worker__close modal__close" aria-label="Close modal" data-micromodal-close>
                    <svg>
                        <use xlink:href="<?= getSvgSpriteUrl() ?>#close"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>