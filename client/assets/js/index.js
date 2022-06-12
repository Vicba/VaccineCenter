"use strict";

document.addEventListener("DOMContentLoaded", init);

function init() {
    addOptions();
    addAverageCases();
    document.querySelector("#submit").addEventListener("click", addBooking);
}

/*  display vaccines in dropdown list*/
function addOptions() {
    fetch("http://localhost/api/vaccine")
        .then(res => res.json())
        .then(data => addOption(data))
        .catch(err => console.log(err));
}

function addOption(vaccines) {
    console.log(vaccines);
    const select = document.querySelector("#vaccine");

    vaccines.data.forEach(vaccine => {
        select.insertAdjacentHTML("beforeend", `<option value=${vaccine.id}>${vaccine.name}</option>`);
    });
}


/*    add booking   */
function addBooking(e) {
    e.preventDefault();
    console.log("clicked");

    const booking = {
        "name": document.querySelector("#name").value,
        "vaccine_id": document.querySelector("#vaccine").value,
        "date": document.querySelector("#date").value,
        "allergies": document.querySelector("#allergies").value
    };

    fetch("http://localhost/api/booking", {
        method: "POST",
        body: JSON.stringify(booking),
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(res => res.json())
        .then(json => console.log("success", json))
        .then(displayThankYou())
        .catch(err => console.log(err));

}

function displayThankYou() {
    const formSection = document.querySelector(".form");
    formSection.innerHTML = `<h2>Thank you!</h2>
                       <p>Your booking has been added.</p>
                       <a href='index.html'>Add another booking</a>`;
}


function addAverageCases() {
    fetch("https://fredericvlummens.be/howest/covid.php")
        .then(res => res.json())
        .then(json => {
            const data = json.data.filter(el => el.date.startsWith("2021")).map(el => el.casesDaily);
            const avg = data.reduce((acc, val) => acc + val, 0) / data.length;

            document.querySelector("span").innerHTML = parseInt(avg);
        })
        .catch(err => console.log(err));
}

