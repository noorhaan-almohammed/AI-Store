// DOM Elements
const showErrorBtn = document.getElementById("showError");
const showWarningBtn = document.querySelectorAll("#showWarning");
const showSuccessBtn = document.getElementById("showSuccess");
const overlay = document.querySelector(".overlay");
const alertContainer = document.querySelector(".alert-container");
const alerts = document.querySelectorAll(".alert");
const cancelButtons = document.querySelectorAll(".alert .cancel");
const confirmButtons = document.querySelectorAll(".alert .confirm");

// Show Error Alert
if (showErrorBtn) {
  showErrorBtn.addEventListener("click", () => {
    overlay.classList.add("active");
    alertContainer.classList.add("active");
    alerts.forEach((alert) => alert.style.display = "none");
    document.querySelector(".alert.error").style.display = "flex";
  });
}

// Show Warning Alert
if (showWarningBtn) {
  showWarningBtn.forEach(el => {
    el.addEventListener("click", () => {
      overlay.classList.add("active");
      alertContainer.classList.add("active");
      alerts.forEach((alert) => alert.style.display = "none");
      document.querySelector(".alert.warning").style.display = "flex";
    });
  });

}

// Show Success Alert
if (showSuccessBtn) {
  showSuccessBtn.addEventListener("click", () => {
    overlay.classList.add("active");
    alertContainer.classList.add("active");
    alerts.forEach((alert) => alert.style.display = "none");
    document.querySelector(".alert.success").style.display = "flex";
  });
}

// Close Alerts on Cancel Button Click
cancelButtons.forEach((cancelBtn) => {
  cancelBtn.addEventListener("click", () => {
    overlay.classList.remove("active");
    alertContainer.classList.remove("active");
  });
});

// Handle Confirm Button Click
confirmButtons.forEach((confirmBtn) => {
  confirmBtn.addEventListener("click", () => {
    alert("Action confirmed!");
    overlay.classList.remove("active");
    alertContainer.classList.remove("active");
  });
});