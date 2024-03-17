function validate_info(event) {
    const clickedButton = event.submitter;

    if (clickedButton.name === "change") {
        console.log("Change button clicked");
        const password = document.getElementById("password").value.trim();
        const mail = document.getElementById("mail").value.trim();
        const mobile = document.getElementById("mobile").value.trim();

        if (password === "" || mail === "" || mobile === "") {
            alert("Fields cannot be empty");
            return false;
        } else if (password.length < 6) {
            alert("Password Length should be atleast 6");
            return false;
        }

    } else console.log("Invalid form submission");

    return true;
}