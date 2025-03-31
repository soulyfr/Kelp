const posts = document.querySelectorAll('.post');
const displayBox = document.querySelector('.image-display');
const postDisplay = document.querySelector('.post-display');

const categoryButtons = document.querySelectorAll('.category-button'); 
const pageButtons = document.querySelectorAll('.page-button');
const allButton = document.querySelector('.all-button');

const browsing = new URLSearchParams(window.location.search).get('browsing') === 'true';

const searchBar = document.querySelector('.search-bar');

const logInBox = document.querySelector('.auth-box');
const logInButton = document.querySelector('.auth-button.login');
const closeLogin = document.querySelector('.close-button');

if(logInButton != null) {

    logInButton.addEventListener('click', () => {
        logInBox.classList.add('active');
    });
}

closeLogin.addEventListener('click', () => {
    logInBox.classList.remove('active');
});

window.addEventListener('beforeunload', () => {
    localStorage.setItem('scrollPosition', window.scrollY);
});

window.addEventListener('load', () => {
    const savedPosition = localStorage.getItem('scrollPosition');
    if (savedPosition) {
        window.scrollTo(0, savedPosition);
    }
    if(browsing) {
        window.scrollTo({left: 0,top : 325, behavior: "smooth"});
    }
});





posts.forEach(post => {
    post.addEventListener('mouseenter', () => {
        const img = post.querySelector('.source-img');
        if(img) {
            const imgClone = img.cloneNode(true);
            imgClone.classList.replace('source-img', 'displayed-img');
            displayBox.innerHTML = '';
            displayBox.appendChild(imgClone);
        }
    });

    post.addEventListener('mouseleave', () => {

        displayBox.innerHTML = '';
    });

    post.addEventListener('click', () => {
        const postClone = post.cloneNode(true);
        const closeButton = document.createElement('img');
        const reviewBox = postClone.querySelector('.review');
        //const imageBox = document.createElement('div');

        closeButton.src = 'close-button.svg';
        closeButton.classList.add('close-button');
        
        //imageBox.classList.add('image-box');
        //reviewBox.appendChild(imageBox);

        closeButton.addEventListener('click', () => {
            postDisplay.classList.remove('active');
        })

        postClone.classList.replace('post', "displayed-post");
        postClone.appendChild(closeButton);
        postDisplay.innerHTML = '';
        postDisplay.appendChild(postClone);
        postDisplay.classList.add('active');
    });


});

categoryButtons.forEach(button => {
    button.addEventListener('click', () =>  {
        const category = button.textContent;
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);

        const params = new URLSearchParams(url.search);
        params.set('category', category);

        url.search = params.toString();

        const newUrl = url.toString();
        window.location.href = newUrl;
    })
})

allButton.addEventListener('click', () =>  {
    const category = allButton.textContent;
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);

    const params = new URLSearchParams(url.search);
    params.set('category', category);

    url.search = params.toString();

    const newUrl = url.toString();
    window.location.href = newUrl;
})

pageButtons.forEach(button => {
    button.addEventListener('click', () =>  {
        const page = button.getAttribute('page');
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);

        const params = new URLSearchParams(url.search);
        params.set('page', page);
        params.set('browsing', "true");

        url.search = params.toString();

        const newUrl = url.toString();
        window.location.href = newUrl;
    })
})

searchBar.addEventListener('input', (event) => {
    const searchText = event.target.value.toLowerCase();

    posts.forEach(post => {
        const serviceName = post.querySelector('.service').textContent.toLowerCase();

        if(!serviceName.includes(searchText)) {
            post.style.display = 'none';
        } else {
            post.style.display = 'flex';
        }
    })
});