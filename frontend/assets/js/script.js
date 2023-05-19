ptRadioButton.addEventListener('click', showPtId);
memberRadioButton.addEventListener('click', showPtId);

function showPtId() {
    let ptIdInput = document.querySelector(".pt-id");
    let ptIdLabel = document.querySelector(".pt-id-label");
    console.log("hello from pt id");
    ptIdInput.style.display = "block";
    ptIdLabel.style.display = "block";
}

function hidePtId() {
    let ptIdInput = document.querySelector(".pt-id");
    let ptIdLabel = document.querySelector(".pt-id-label");
    ptIdInput.style.display = "none";
    ptIdLabel.style.display = "none";
}