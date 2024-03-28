const myAlert = document.querySelector('.alert');
const alertCloseBtn = document.querySelector('btn-close');

//rimuovo la classe show in modo che l'alert svanisca piano
//e poi aspetto 100 ms per rimuoverlo altrimenti rimane lo spazio bianco che sarebbe occupato da esso
setTimeout(() => {
    myAlert.classList.remove('show')
    setTimeout(() => {
        myAlert.classList.add('d-none')
    }, 100)
}, 5000)