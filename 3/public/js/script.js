window.onload = () => {
    const boutonsSwitch = document.querySelectorAll(".form-check-input");

    for (let boutonS of boutonsSwitch) {
        boutonS.addEventListener("click", activer)
    }

}

function activer() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open('GET', '/admin/activeAnnonce/' + this.dataset.id);
    xmlhttp.send();
}

const alert = document.querySelectorAll(".alert");

function closeTimeOut() {
    setTimeout(() => {
        alert.forEach(a => {
            a.style.display = "none";
        })
    }, 2000);
}
closeTimeOut();