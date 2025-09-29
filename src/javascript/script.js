document.addEventListener("DOMContentLoaded", () => {
  const editButtons = document.querySelectorAll(".edit-button");

  // Add event listener to each edit button
  editButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      const task = button.closest(".task"); // Find the closest task element to the edit button
      const editForm = task.querySelector(".edit-task"); // Find the edit form inside the task
      editForm.classList.toggle("hidden"); // Toggle the hidden class on the edit form
    });
  });
});
