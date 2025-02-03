const selectBoxes = document.querySelectorAll(".select-box");

selectBoxes.forEach(selectBox => {
    const selected = selectBox.querySelector(".selected");
    const optionsContainer = selectBox.querySelector(".options-container");
    const optionsList = selectBox.querySelectorAll(".option");

    selected.addEventListener("click", () => {
        optionsContainer.classList.toggle("active");
    });

    optionsList.forEach(o => {
        o.addEventListener("click", () => {
            selected.innerHTML = o.querySelector("label").innerHTML;
            optionsContainer.classList.remove("active");
        });
    });
});
