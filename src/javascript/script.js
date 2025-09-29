document.addEventListener("DOMContentLoaded", () => {
  const editButtons = document.querySelectorAll(".edit-button");

  editButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      const task = button.closest(".task");
      const editForm = task.querySelector(".edit-task");
      editForm.classList.toggle("hidden");
    });
  });
});
