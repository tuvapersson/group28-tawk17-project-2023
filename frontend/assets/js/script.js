ptRadioButton.addEventListener('click', showPtId);
memberRadioButton.addEventListener('click', showPtId);

function showPtId() {
    let ptIdInput = document.querySelector(".pt-id");
    console.log("hello from pt id");
    ptIdInput.style.display = "block";
}

function hidePtId() {
    let ptIdInput = document.querySelector(".pt-id");
    ptIdInput.style.display = "none";
}