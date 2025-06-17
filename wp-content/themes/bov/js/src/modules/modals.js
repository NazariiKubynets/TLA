let modalConfig = {
  onShow: modal => {
    d.get('body').classList.add('is-modal-open');
    const modalContent = modal.querySelector('.modal-worker__container');
    if (modalContent) {
      modalContent.scrollTop = 0;
    }
  },
  onClose: modal => d.get('body').classList.remove(`is-modal-open`),
  openTrigger: 'data-micromodal-open',
  closeTrigger: 'data-micromodal-close',
  openClass: 'is-open',
  disableScroll: true,
  disableFocus: true,
  awaitOpenAnimation: true,
  awaitCloseAnimation: true,
};

function initModals() {

  MicroModal.init(modalConfig);

  function manageClickOnSmallScreens() {
    const modalTriggerElements = document.querySelectorAll('.introduction__swiper-slide');

    const handleResize = () => {
      const isSmallScreen = window.innerWidth < 992;

      modalTriggerElements.forEach((element) => {
        if (isSmallScreen) {
          element.addEventListener('click', handleClick);
        } else {
          element.removeEventListener('click', handleClick);
        }
      });
    };

    const handleClick = () => {
      if (document.body.classList.contains('is-modal-open')) {
        document.body.classList.remove('is-modal-open');
      }

      if (document.body.style.overflow === 'hidden') {
        document.body.style.overflow = '';
      }
    };

    handleResize();
    window.addEventListener('resize', handleResize);
  }

  document.addEventListener('DOMContentLoaded', manageClickOnSmallScreens);

  document.addEventListener('DOMContentLoaded', function () {
    const tourHero = document.querySelector('.tour-hero');
    if (!tourHero) return;

    function setupImgModal(selector) {
      const imgItems = document.querySelectorAll(selector);

      imgItems.forEach(item => {
        item.addEventListener('click', function () {
          const imgTag = this.querySelector('img');
          const modalImgContainer = document.querySelector('.modal-tour-photo__img');

          const existingImg = modalImgContainer.querySelector('img');
          if (existingImg) {
            modalImgContainer.removeChild(existingImg);
          }

          if (imgTag) {
            const clonedImg = imgTag.cloneNode(true);
            modalImgContainer.appendChild(clonedImg);
          }
        });
      });
    }

    setupImgModal('.introduction__info-block-img');
    setupImgModal('.introduction__info-block-secondary-img');
    setupImgModal('.introduction__img');
  });





  document.addEventListener('DOMContentLoaded', function () {
    const homeHero = document.querySelector('.home-hero');
    if (!homeHero) return;
    function setupWorkerModal(selector, dataWorker) {
      const workerItems = document.querySelectorAll(selector);

      workerItems.forEach(item => {
        item.addEventListener('click', function () {

          const index = this.getAttribute('data-index');
          const imgTag = this.querySelector('img');
          const modalImgContainer = document.getElementById('modal-worker-img');

          modalImgContainer.innerHTML = '';

          if (imgTag) {
            const clonedImg = imgTag.cloneNode(true);
            modalImgContainer.appendChild(clonedImg);
          }

          const worker = dataWorker[index];

          document.getElementById('modal-worker-name').textContent = worker.name;
          document.getElementById('modal-worker-position').textContent = worker.position || worker.country;
          document.getElementById('modal-worker-text').innerHTML = worker.description;
        });
      });
    }

    setupWorkerModal('.leadership__item', leadership);
    setupWorkerModal('.team__item', guides);
  });


}

export {initModals, modalConfig};