<?php
/**
 * @var array $args
 */

$leadership = $args['field'];
?>

<div class="leadership">
    <div class="leadership__container container">
        <h3 class="leadership__title title-l">
            <?= $leadership['title'] ?>
        </h3>
        <div class="leadership__grid">
            <?php if (isset($leadership['leaderships']) && !empty($leadership['leaderships'])) : ?>
                <?php foreach ($leadership['leaderships'] as $index => $item) { ?>
                    <div class="leadership__item <?= $index >= 3 ? 'hidden' : '' ?>" data-micromodal-open="modal-worker" data-index="<?= $index ?>">
                        <div class="leadership__img">
                            <?= wp_get_attachment_image_lazy($item['img'], 'medium_large', 'img'); ?>
                            <svg class="leadership__icon">
                                <use xlink:href="<?= getSvgSpriteUrl() ?>#leadership-plus"/>
                            </svg>
                        </div>
                        <h4 class="leadership__name title-m"><?= $item['name'] ?></h4>
                        <p class="leadership__position"><?= $item['position'] ?></p>
                    </div>
                <?php } ?>
            <?php endif; ?>
        </div>
        <?php get_template_part('templates/modals/_worker', null,); ?>
        <button class="leadership__btn btn">
            See More
        </button>
    </div>
</div>

<script>
    const leadership = <?= json_encode($leadership['leaderships']); ?>;
</script>