function validate_password(event) {
    const clickedButton = event.submitter;

    if (clickedButton.name === "change") {
        console.log("Change button clicked");
        const pass1 = document.getElementById("pass1").value.trim();
        const pass2 = document.getElementById("pass2").value.trim();

        if (pass1 === "" || pass2 === "") {
            alert("Please enter both username and password.");
            return false;
        } else if (pass1 != pass2) {
            alert("Both Passwords should be same");
            return false;
        } else if (pass1.length < 6 || pass2.length < 6) {
            alert("Length should be atleast 6");
            return false;
        }
        
    } else console.log("Invalid form submission");

    return true;
}