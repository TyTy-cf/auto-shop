import {Modal} from 'bootstrap';

(function() {
    const adminAreaBtns = document.querySelectorAll('.admin-area-modal-btn');
    const modal = document.querySelector('#admin-area-modal');
    const bsModal = new Modal(modal);

    adminAreaBtns.forEach((button: HTMLButtonElement) => {
        button.addEventListener('click', () => {

            let url = '/api/administrative_areas/' + button.getAttribute('data-aa-id');
            fetchAdminArea(url);

        });
    });


    function fillModal(adminArea, parentArea = null)
    {
        let toFilledSection = modal.querySelector('.admin-area-info');
        toFilledSection.querySelector('.aa-name').innerHTML =  adminArea.name;
        toFilledSection.querySelector('.aa-code').innerHTML =  adminArea.code;


        let $parentCode = toFilledSection.querySelector<HTMLSpanElement>('.aa-parent');
        $parentCode.closest('li').className = '';

        if(adminArea.parentCode == null) {
            $parentCode.closest('li').classList.add('d-none');
        } else {
            toFilledSection.querySelector('.aa-parent').innerHTML =  parentArea.name;
        }

    }

    function fetchAdminArea(url: string)
    {
        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        }).then((response: Response) => {

            return response.json();
        }).then((adminArea) => {

            if(adminArea.parentCode !== null) {
                fetchAdminArea('/api/administrative_areas/' + adminArea.parentCode)
                fillModal(adminArea, parentArea);
            } else {
                fillModal(adminArea);
            }
        });

        bsModal.show();
    }
})();
