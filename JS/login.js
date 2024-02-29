function alertInvalidInfo(){
    const urlParams = new URLSearchParams(window.location.search);
    const invalidLogin = urlParams.get('invalid');
    const password_updated = urlParams.get('PasswordUpdated');

    if (invalidLogin) {
        alert("Invalid username or password!");
    }
    if (password_updated) {
        alert("Password Updated Successfully");
    }
    return true;
}

function changelogintype(buttonId) {
    const loginTitle = document.getElementById("login-title");
    const studentLoginButton = document.getElementById("student_login");
    const teacherLoginButton = document.getElementById("teacher_login");
    const adminLoginButton = document.getElementById("admin_login");
    const loginPreferenceInput = document.getElementById("login_preference");

    if (buttonId === 'student_login') {
        loginTitle.innerHTML = "Student Login";
        studentLoginButton.style.backgroundColor = "black";
        studentLoginButton.style.color = "green";
        teacherLoginButton.style.color = "black";
        teacherLoginButton.style.backgroundColor = "lightgrey";
        adminLoginButton.style.color = "black";
        adminLoginButton.style.backgroundColor = "lightgrey";
        loginPreferenceInput.value = "student";
    } else if (buttonId === 'teacher_login') {
        loginTitle.innerHTML = "Teacher Login";
        teacherLoginButton.style.backgroundColor = "black";
        teacherLoginButton.style.color = "green";
        studentLoginButton.style.color = "black";
        studentLoginButton.style.backgroundColor = "lightgrey";
        adminLoginButton.style.color = "black";
        adminLoginButton.style.backgroundColor = "lightgrey";
        loginPreferenceInput.value = "teacher";
    } else if (buttonId === 'admin_login') {
        loginTitle.innerHTML = "Admin Login";
        adminLoginButton.style.backgroundColor = "black";
        adminLoginButton.style.color = "green";
        studentLoginButton.style.color = "black";
        studentLoginButton.style.backgroundColor = "lightgrey";
        teacherLoginButton.style.color = "black";
        teacherLoginButton.style.backgroundColor = "lightgrey";
        loginPreferenceInput.value = "admin";
    }
}

function validateForm(event) {

    const clickedButton = event.submitter;

    if (clickedButton.name === "login") {
        console.log("Login button clicked");
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        if (username.trim() === "" || password.trim() === "") {
            alert("Please enter both username and password.");
            return false;
        }
        
    } else console.log("Invalid form submission");

    return true;
}
