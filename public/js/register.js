let labelarea = document.getElementById("labeldescri")
let textarea = document.getElementById("registration_form_description")
let checkbox = document.getElementById("registration_form_roles")
console.log(checkbox)

document.getElementById("registration_form_roles").addEventListener("click", function() {
    console.log(textarea.classList)
    if (textarea.classList.length > 0) {

        textarea.classList.remove("d-none");
        labelarea.classList.remove("d-none");
        textarea.setAttribute("required", true);
    } else {
        labelarea.classList.add("d-none");
        textarea.classList.add("d-none");
        textarea.setAttribute("required", false);
    }
})