

<?php
$contact = get_field('contact', 'option');
$footer = get_field('footer', 'option');


get_template_part('templates/blocks/_contact', null, [
    'field' => $contact]);
?>
</main>

<footer class="main-footer">
    <div class="container" id="footer-bg">
        <div class="main-footer__wrap">
            <a href="<?= home_url() ?>" class="main-footer__logo main-footer__logo--mobile">
                <?= wp_get_attachment_image_lazy($footer['logo'] ) ?>
            </a>
            <div class="main-footer__column">
                <nav class="footer-menu">
                    <p class="main-footer__info-text">company</p>
                    <?php echo getMenu('footer-menu', 'footer-menu'); ?>
                    <p class="main-footer__info-text">information</p>
                    <ul class="main-footer__information">
                        <?php if (isset($footer['information']) && !empty($footer['information'])) : ?>
                            <?php foreach ($footer['information'] as $item) { ?>
                                <li class="main-footer__information-item">
                                    <a href="<?= $item['link']['url'] ?>"><?= $item['link']['title'] ?></a>
                                </li>
                            <?php } ?>
                        <?php endif; ?>
                    </ul>
                </nav>
                <div class="main-footer__column-contact">
                    <div class="main-footer__subscription">
                        <p class="main-footer__info-text">Subscribe to our Newsletter</p>
                        <div class="klaviyo-form-VQwcta main-footer__form"></div>
                    </div>
                    <div class="main-footer__contact">
                        <p class="main-footer__info-text">contacts</p>
                        <a href="tel:<?= str_replace(' ', '', $contact['number_free']) ?>"
                           class="main-footer__contact-tel"
                           target="_blank"
                           rel="nofollow">
                            <?= $contact['text_number_one'] ?>: <?= $contact['number_free'] ?>
                        </a>
                        <a href="tel:<?= str_replace(' ', '', $contact['number_direct']) ?>""
                        class="main-footer__contact-tel"
                        target="_blank"
                        rel="nofollow">
                        <?= $contact['text_number_two'] ?>: <?= $contact['number_direct'] ?>
                        </a>
                        <a class="main-footer__btn btn" href="<?= $contact['link_buttons_secondary']['url'] ?>">
                            <?= $contact['link_buttons_secondary']['title'] ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="main-footer__column">
                <a href="<?= home_url() ?>" class="main-footer__logo main-footer__logo--desk">
                    <?= wp_get_attachment_image_lazy($footer['logo'] ) ?>
                </a>
                <div class="main-footer__achievement">
                    <?php if (isset($footer['achievement']) && !empty($footer['achievement'])) : ?>
                        <?php foreach ($footer['achievement'] as $item) { ?>
                            <div class="main-footer__item">
                                <?= wp_get_attachment_image_lazy($item['logo'], 'medium', "img img--contain") ?>
                            </div>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="main-footer__bottom">
            <div class="main-footer__row">
                <a class="main-footer__info" href=" <?= $footer['regulations']['url'] ?>"> <?= $footer['regulations']['title'] ?></a>
                <a class="main-footer__info" href=" <?= $footer['policy']['url'] ?>"> <?= $footer['policy']['title'] ?></a>
            </div>
            <p class="main-footer__info"><?= $footer['copyright'] ?></p>
        </div>
    </div>
</footer>
<script>
    window.addEventListener("load", function () {
        setTimeout(function() {
            var klaviyoScript = document.createElement("script");
            klaviyoScript.type = "text/javascript";
            klaviyoScript.async = true;
            klaviyoScript.src = "https://static.klaviyo.com/onsite/js/T6ZYT4/klaviyo.js";
            document.body.appendChild(klaviyoScript);
        }, 3000);
    });
</script>

<?php wp_footer(); ?>
</body>

</html>