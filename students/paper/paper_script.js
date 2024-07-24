document.addEventListener("DOMContentLoaded", function() {
    const questionNumbers = document.querySelectorAll(".question-number");

    questionNumbers.forEach(button => {
        button.addEventListener("click", function() {
            document.querySelector(".question-number.active").classList.remove("active");
            button.classList.add("active");
            // Load the corresponding question here
        });
    });
});
