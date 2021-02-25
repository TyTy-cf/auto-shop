const postContainer = document.querySelector('#more-content-post');
const morePostBtn = document.querySelector<HTMLButtonElement>('#more-posts-btn');

let page = 2;

morePostBtn.addEventListener('click', () => {
    let url = '/async/more-post?page=' + page;

    fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'text/html',
            'Content-Type': 'text/html',
        }
    }).then((response: Response) => {
        return response.text();
    }).then((data: string) => {
        if(data == '') {
            morePostBtn.disabled = true;
        }

        let content = postContainer.innerHTML;
        postContainer.innerHTML = content + data;

    });

    page++;
});
