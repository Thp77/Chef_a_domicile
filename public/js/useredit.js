let labelareaUser = document.getElementById("labelDescript")
let textareaUser = document.getElementById("userDescription")
let checkboxUser = document.getElementById("user_roles")
console.log(textareaUser.classList.contains("d-none"))
document.getElementById("user_roles").addEventListener("click", function() {

    if (textareaUser.classList.length > 0) {

        textareaUser.classList.remove("d-none");
        labelareaUser.classList.remove("d-none");
        textareaUser.setAttribute("required", true);
    } else {
        labelareaUser.classList.add("d-none");
        textareaUser.classList.add("d-none");
        textareaUser.setAttribute("required", false);
    }
})