let modalConfig = {
  onShow: modal => d.get('body').classList.add(`is-modal-open`),
  onClose: modal => d.get('body').classList.remove(`is-modal-open`),
  openTrigger: 'data-micromodal-open', //add to <a>  data-micromodal-open="demo-modal"
  closeTrigger: 'data-micromodal-close',  
  openClass: 'is-open',
  disableScroll: true,  //use href="javascript:;"
  disableFocus: true,
  awaitOpenAnimation: true,
  awaitCloseAnimation: true,
};

function initModals() {

  MicroModal.init(modalConfig);

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