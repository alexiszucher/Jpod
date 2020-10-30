document.getElementById("depense").style.display = "none";
document.getElementById("gain").style.display = "none";
document.getElementById("compte").style.display = "none";
document.getElementById("transaction").style.display = "none";

function ShowFormGain() {
    if (document.getElementById("gain").style.display == "block") {
        document.getElementById("gain").style.display = "none";
    } else {
        document.getElementById("gain").style.display = "block";
    }
}

function ShowFormDepense() {
    if (document.getElementById("depense").style.display == "block") {
        document.getElementById("depense").style.display = "none";
    } else {
        document.getElementById("depense").style.display = "block";
    }
}

function showCompte() {
    if (document.getElementById("compte").style.display == "block") {
        document.getElementById("compte").style.display = "none";
    } else {
        document.getElementById("transaction").style.display = "none";
        document.getElementById("compte").style.display = "block";
    }
}

function showTransaction() {
    if (document.getElementById("transaction").style.display == "block") {
        document.getElementById("transaction").style.display = "none";
    } else {
        document.getElementById("transaction").style.display = "block";
        document.getElementById("compte").style.display = "none";
    }
}