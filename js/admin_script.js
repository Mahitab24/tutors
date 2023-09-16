let footer = document.querySelector('.footer');
let body = document.body;
let profil = document.querySelector('.header .header-flex .profil');
let search = document.querySelector('.header .header-flex .search');
let sideBar = document.querySelector('.sidebar');
document.querySelector('#user-btn').onclick =()=>{
   profil.classList.toggle('active');
}

document.querySelector('#search-btn').onclick =()=>{
   search.classList.toggle('active');
   profil.classList.remove('active');
}

document.querySelector('#menu-btn').onclick =()=>{
sideBar.classList.toggle('active');
footer.classList.toggle('active');
body.classList.toggle('active');
}
document.querySelector('#close').onclick =()=>{
   sideBar.classList.remove('active');
   
   }


window.onscroll=()=>{
   profil.classList.remove('active');
   search.classList.remove('active');

if(window.innerWidth < 1200){
sideBar.classList.toggle('active');
footer.classList.remove('active');
body.classList.remove('active');
}

}