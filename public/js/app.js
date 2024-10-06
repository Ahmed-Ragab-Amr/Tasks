document.addEventListener('DOMContentLoaded', function () {
    // Event listeners for Edit and Delete buttons
    const editButtons = document.querySelectorAll('.btn-warning');
    const deleteButtons = document.querySelectorAll('.btn-danger');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            alert('Edit button clicked');
        });
    });

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            confirm('Are you sure you want to delete this task?');
        });
    });
});
