let labelarea = document.getElementById("labeldescri")
let textarea = document.getElementById("registration_form_description")
let checkbox = document.getElementById("registration_form_roles")

document.getElementById("registration_form_roles").addEventListener("click", function() {
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