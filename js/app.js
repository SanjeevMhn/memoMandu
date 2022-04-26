document.addEventListener('DOMContentLoaded',function(){
    let wrapper = document.querySelector('.wrapper');
    let statusMsg = document.querySelector('.status-msg');
    setTimeout(() => {
        wrapper.removeChild(statusMsg);  
    }, 3000);
    
    let path = window.location.pathname;
    let page = path.split('/').pop();

    let menuOptions = document.querySelectorAll('.nav-item');
    let arrMenuOpt =  Array.from(menuOptions);

    console.log(menuOptions);
    menuOptions.forEach((am,index)=>{
        am.addEventListener('click',()=>{
            am.parentNode.children[index].classList.remove('active');

        })
    })
    switch(page){
        case 'index.php' || '':
            arrMenuOpt[0].classList.add('active')
        break;
        case 'AddPosts.php':
            arrMenuOpt[1].classList.add('active')
        break;
        case 'FavoritesPage.php':
            arrMenuOpt[2].classList.add('active')
        break;
        case 'Saved.php':
            arrMenuOpt[3].classList.add('active')
        break;
    }
});
