// On veut intéragir sur les formulaires d'inscription selon si l'utilisateur est un chef ou non
// On récupère sous forme de variable les différentes parties du formulaire user et register qui nous intéressent
let labelarea = document.querySelector(".label_user_descript")
let textarea = document.querySelector(".textarea_user_descript")
let checkboxrole = document.querySelector(".checkbox_user_rol")

// On définit une fonction qui fonctionne au click de la checkbox (rôle cuisinier)
// qui permet de faire apparaître le textarea ainsi son label pour que l'utilisateur se décrive pour se vendre.
// D'où le fait que l'on passe le textarea en required

checkboxrole.addEventListener("click", function() {
    if (textarea.classList.contains("d-none")) {
        textarea.classList.remove("d-none");
        labelarea.classList.remove("d-none");
        textarea.setAttribute("required", true);
    } else {
        labelarea.classList.add("d-none");
        textarea.classList.add("d-none");
        textarea.setAttribute("required", false);
    }
})