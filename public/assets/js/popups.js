const addUserBtn = document.getElementById("addUser");
const editUserBtn = document.getElementById("editUser");
const addItemBtn = document.getElementById("addItem");
const editItemBtn = document.getElementById("editItem");
const addCategoryBtn = document.getElementById("addCategory");
const editCategoryBtn = document.getElementById("editCategory");

const cancelPopupButtons = document.querySelectorAll(".popup .cancel");
const popups = document.querySelectorAll(".popup");
const popupContainer = document.querySelector(".popup-container");
const popupOverlay = document.querySelector(".overlay");


// ! users
if (addUserBtn) {
    addUserBtn.addEventListener("click", () => {
        popupOverlay.classList.add("active");
        popupContainer.classList.add("active");
        popups.forEach((alert) => alert.style.display = "none");
        document.querySelector(".popup.addUser").style.display = "block";
    });
}

if (editUserBtn) {
    editUserBtn.addEventListener("click", () => {
        popupOverlay.classList.add("active");
        popupContainer.classList.add("active");
        popups.forEach((alert) => alert.style.display = "none");
        document.querySelector(".popup.editUser").style.display = "block";
    });
}

// ! items
if (addItemBtn) {
    addItemBtn.addEventListener("click", () => {
        popupOverlay.classList.add("active");
        popupContainer.classList.add("active");
        popups.forEach((alert) => alert.style.display = "none");
        document.querySelector(".popup.addItem").style.display = "block";
    });
}

if (editItemBtn) {
    editItemBtn.addEventListener("click", () => {
        popupOverlay.classList.add("active");
        popupContainer.classList.add("active");
        popups.forEach((alert) => alert.style.display = "none");
        document.querySelector(".popup.editItem").style.display = "block";
    });
}

// ! Category
if (addCategoryBtn) {
    addCategoryBtn.addEventListener("click", () => {
        popupOverlay.classList.add("active");
        popupContainer.classList.add("active");
        popups.forEach((alert) => alert.style.display = "none");
        document.querySelector(".popup.addCategory").style.display = "block";
    });
}

if (editCategoryBtn) {
    editCategoryBtn.addEventListener("click", () => {
        popupOverlay.classList.add("active");
        popupContainer.classList.add("active");
        popups.forEach((alert) => alert.style.display = "none");
        document.querySelector(".popup.editCategory").style.display = "block";
    });
}

// Close Alerts on Cancel Button Click
cancelPopupButtons.forEach((cancelBtn) => {
    cancelBtn.addEventListener("click", () => {
        overlay.classList.remove("active");
        popupContainer.classList.remove("active");
    });
});