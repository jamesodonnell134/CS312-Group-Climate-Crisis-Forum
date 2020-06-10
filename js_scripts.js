function togglePassVis2(){
    var x = document.getElementById("pwd");
    var y = document.getElementById("pwdc");
    if (x.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}

function togglePassVis1(){
    var x = document.getElementById("pwd");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function goBack(){
    window.history.back();
}

function check() {
    var x = document.getElementById("pwd");
    var y = document.getElementById("pwdc");
    x.style.backgroundColor = "white";
    y.style.backgroundColor = "white";
    if (!(x.value === y.value)) {
        document.getElementById("message").innerHTML = "<div style='color: red;'>Passwords do not match!</div>";
        x.style.backgroundColor = "pink";
        y.style.backgroundColor = "pink";
    } else {
        document.getElementById("message").innerHTML = "<br>";
    }
}

function validateForm() {

    var comment = document.forms["reply"]["comment"];
    var errs = "";


    if ((comment.value.length <= 0)) {
        errs += "  *Comment must not be empty!\n";
    }

    if ((comment.value.length > 1500)) {
        errs += "  *Comment must be less than 1500 characters! \n";
    }

    if (errs != "") {
        alert("Sorry. The following errors need to be corrected: \n\n" + errs);
    }

    return (errs == "");
}

function validateForm2() {
    var topic = document.forms["newtopic"]["topic"];
    var content = document.forms["newtopic"]["content"];

    var errs = "";


    if ((topic.value.length <= 0)) {
        errs += "  *Please fill in the topic field!\n";
    }

    if ((topic.value.length > 50)) {
        errs += "  *Topic length must not be greater than 50 characters!\n";
    }

    if ((content.value.length <= 0)) {
        errs += "  *Please fill in the content field!\n";
    }

    if ((content.value.length > 1500)) {
        errs += "  *Content field must be no greater than 1500 characters!\n";
    }

    if (errs != "") {
        alert("Sorry. The following errors need to be corrected: \n\n" + errs);
    }

    return (errs == "");
}