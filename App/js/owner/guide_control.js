function guideActivate() {
    const helpNav = document.querySelector('.profile__nav__link#dash_6'),
        appGuide = document.querySelector('.app__guide'),
        closeGuide = document.querySelector('.app__guide .close__guide');

    helpNav.addEventListener('click', () => {
        if (appGuide.classList.contains('hide')) {
            appGuide.classList.remove('hide');
        }
    });
   

    closeGuide.addEventListener('click', () => {
        appGuide.classList.add('hide');
    });
     
}