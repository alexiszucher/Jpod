document.getElementById("depense").style.display="none";
document.getElementById("gain").style.display="none";
document.getElementById("leads").style.display="none";
//document.getElementById("compte").style.display="none";
document.getElementById("objectif").style.display="none";
document.getElementById("sujets").style.display="none";
document.getElementById("transaction").style.display="none";

function ShowFormGain()
{
    if(document.getElementById("gain").style.display == "block")
    {
        document.getElementById("gain").style.display="none";
    }
    else
    {
        document.getElementById("gain").style.display = "block";
    }
}

function ShowFormDepense()
{
    if(document.getElementById("depense").style.display == "block")
    {
        document.getElementById("depense").style.display="none";
    }
    else
    {
        document.getElementById("depense").style.display = "block";
    }
}

function ShowFormLeads()
{
    if(document.getElementById("leads").style.display == "block")
    {
        document.getElementById("leads").style.display="none";
    }
    else
    {
        document.getElementById("leads").style.display = "block";
    }
}

function showCompte()
{
    if(document.getElementById("compte").style.display == "block")
    {
        document.getElementById("compte").style.display="none";
    }
    else
    {
        document.getElementById("objectif").style.display="none";
        document.getElementById("transaction").style.display="none";
        document.getElementById("compte").style.display = "block";
    }
}

function showObjectif()
{
    if(document.getElementById("objectif").style.display == "block")
    {
        document.getElementById("objectif").style.display="none";
    }
    else
    {
        document.getElementById("compte").style.display="none";
        document.getElementById("transaction").style.display="none";
        document.getElementById("objectif").style.display = "block";
    }
}

function ShowFormSujet()
{
    if(document.getElementById("sujets").style.display == "block")
    {
        document.getElementById("sujets").style.display="none";
    }
    else
    {
        document.getElementById("sujets").style.display = "block";
    }
}

function showTransaction()
{
    if(document.getElementById("transaction").style.display == "block")
    {
        document.getElementById("transaction").style.display="none";
    }
    else
    {
        document.getElementById("transaction").style.display = "block";
        document.getElementById("compte").style.display="none";
        document.getElementById("objectif").style.display = "none";
    }
}