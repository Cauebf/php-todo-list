document.addEventListener("DOMContentLoaded", () => {
  const editButtons = document.querySelectorAll(".edit-button");
  const checkboxes = document.querySelectorAll(".progress");

  // Add event listener to each edit button
  editButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      const task = button.closest(".task"); // Find the closest task element to the edit button
      const editForm = task.querySelector(".edit-task"); // Find the edit form inside the task
      editForm.classList.toggle("hidden"); // Toggle the hidden class on the edit form
    });
  });

  // Add event listener to each checkbox
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", () => {
      const taskId = checkbox.dataset.taskId; // Get the task ID from the data attribute (data-task-id)
      const completed = checkbox.checked ? 1 : 0; // Get the checkbox state (checked or not)

      // Send a POST request to update the task progress in the database
      fetch("/php-todo-list/actions/update-progress.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded", // Set the content type to form-urlencoded
        },
        body: `task_id=${taskId}&completed=${completed}`,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Error updating task progress");
          }

          // Update the task progress in the UI
          if (completed) {
            checkbox.classList.add("done");
          } else {
            checkbox.classList.remove("done");
          }
        })
        .catch((error) => {
          // Handle errors
          checkbox.checked = !checkbox.checked; // Revert the checkbox state if an error occurs
          console.error(error);
          alert("An error occurred while updating the task progress.");
        });
    });
  });
});
