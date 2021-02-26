import {Modal} from 'bootstrap';

(function() {
    const adminAreaBtns = document.querySelectorAll('.admin-area-modal-btn');
    const modal = document.querySelector('#admin-area-modal');
    const bsModal = new Modal(modal);


    adminAreaBtns.forEach((button: HTMLButtonElement) => {
        button.addEventListener('click', () => {



            bsModal.show();
        });
    });



})();
