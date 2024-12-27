<?php
/**
 * @var array $args
 */

$contact = $args['field'];
?>


<section class="contact">
    <div class="contact__container container">
        <h2 class="contact__title title-l">
            <?= $contact['title'] ?>
        </h2>
        <div class="contact__wrap">
            <div class="contact__column">
                <p class="contact__text"><?= $contact['text_number_one'] ?></p>
                <a href="tel:<?= $contact['number_free'] ?>"
                   class="contact__tel"
                   target="_blank"
                   rel="nofollow">
                    <?= $contact['number_free'] ?>
                </a>
            </div>
            <span class="contact__line"></span>
            <div class="contact__column">
                <p class="contact__text">
                    <?php
                        $text = $contact['text_number_two'];
                        echo preg_replace('/\s*\(.*?\)/', '', $text);
                    ?>
                </p>
                <a href="tel:<?= $contact['number_direct'] ?>"
                   class="contact__tel"
                   target="_blank"
                   rel="nofollow">
                    <?= $contact['number_direct'] ?>
                </a>
            </div>
        </div>
        <a class="btn btn--secondary" href="<?= $contact['link_buttons_main']['url'] ?>">
            <?= $contact['link_buttons_main']['title'] ?>
        </a>
    </div>
</section>

