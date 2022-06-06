const dateNaissanceSelect = document.querySelectorAll("select");
const connexion = document.querySelector(".form-connexion");
const connexionMailMobile = document.querySelector(".mobile");
const inscription = document.querySelector(".form-inscription");
const inscriptionInput = inscription.querySelectorAll("input");
const genre = document.querySelectorAll(".genre");
const buttons = document.querySelectorAll("button");

function creer_option(value, content, select) {
  let el = document.createElement("option");
  el.value = value;
  el.textContent = content;
  select.insertAdjacentElement("beforeend", el);
}

function verify_mobile(mobile, element) {
  if (mobile.includes("+33")) {
    verify = mobile.slice(3).match("[0-9]{9}");
    element.value = "0" + mobile.slice(3);
    if (verify == null) return false;
  }

  verify = mobile.match("[0-9]{9}");

  if (verify == null) return false;

  return true;
}

//soumission connexion
connexion.onsubmit = () => {
  let login = connexionMailMobile.value;

  connexionMailMobile.type = "tel";

  if (login.includes("@")) {
    connexionMailMobile.type = "email";
    return true;
  }
  console.log(buttons[1].value);
  buttons[0].value = "connexion";
  buttons[1].value = "";

  return verify_mobile(login, connexionMailMobile);
};

//soumission inscription
inscription.onsubmit = () => {
  let mailMobile = inscriptionInput[2];
  let mailMobileC = inscriptionInput[3];

  //confirmation du email / mobile
  if (mailMobile.value != mailMobileC.value) return false;

  //c'est un mail
  if (mailMobile.value.includes("@")) {
    mailMobile.type = "email";
    mailMobileC.type = "email";

    return true;
  }

  buttons[0].value = "";
  buttons[1].value = "inscription";

  return verify_mobile(mailMobile.value, mailMobile);
};

//genre checkbox
for (let i = 0; i < 2; i++) {
  genre[i].addEventListener("click", () => {
    genre[i].required = true;
    genre[i].checked = true;

    if (i == 0) {
      genre[1].checked = false;
      genre[1].required = false;
    }

    if (i == 1) {
      genre[0].checked = false;
      genre[0].required = false;
    }
  });
}


//Jour Option
const jour = document.querySelector("#jour");

for (let i = 0; i <= 31; i++) {
  if (i == 0) {
    creer_option("", "Jour", jour);
    continue;
  }

  let zero = "";
  if (i <= 9) zero = "0";

  creer_option(zero + i, i, jour);
}

//Mois option
const mois = document.querySelector("#mois");

for (let i = 0; i <= 12; i++) {
  if (i == 0) {
    creer_option("", "Mois", mois);
    continue;
  }

  let zero = "";
  if (i <= 9) zero = "0";

  creer_option(zero + i, i, mois);
}

//Année option
const annee = document.querySelector("#annee");
const currentYear = new Date().getFullYear();

for (let i = currentYear + 1; 1905 <= i; i--) {
  if (i == currentYear + 1) {
    creer_option("", "Année", annee);
    continue;
  }

  creer_option(i, i, annee);
}
