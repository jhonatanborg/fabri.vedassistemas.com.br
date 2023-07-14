

const listOptions = [
    { value: "all", name: "Todos" },
    { value: "1", name: "CUVG" },
    { value: "2", name: "FAACC" },
    { value: "3", name: "FAAZ" },
    { value: "4", name: "FACC" },
    { value: "5", name: "FAEN" },
    { value: "6", name: "FAET" },
    { value: "7", name: "FAGEO" },
    { value: "8", name: "FANUT" },
    { value: "9", name: "FAVET" },
    { value: "10", name: "FD" },
    { value: "11", name: "FE" },
    { value: "12", name: "FEF" },
    { value: "13", name: "FENF" },
    { value: "14", name: "FM" },
    { value: "15", name: "IB" },
    { value: "16", name: "IC" },
    { value: "17", name: "ICET" },
    { value: "18", name: "ICHS" },
    { value: "19", name: "IE" },
    { value: "20", name: "IGHD" },
    { value: "21", name: "IL" },
    { value: "22", name: "ISC" },
    { value: "23", name: "PRAE" },
    { value: "24", name: "PROADI" },
    { value: "25", name: "PROCEV" },
    { value: "26", name: "PROEG" },
    { value: "27", name: "PROPG" },
    { value: "28", name: "PROPLAN" },
    { value: "29", name: "PROPEQ" },
    { value: "30", name: "Reitoria" },
    { value: "31", name: "SECRI" },
    { value: "32", name: "SECOM" },
    { value: "33", name: "SETEC" },
    { value: "34", name: "SGP" },
    { value: "35", name: "STI" },
    { value: "36", name: "ViceReitoria" },
];

const main = () => {
    // after load page
    document.addEventListener("DOMContentLoaded", () => {
        // get elements
        const select = document.getElementById("select");

        // add options
        listOptions.forEach((option) => {
            const element = document.createElement("option");
            element.value = option.value;
            element
                .appendChild(document.createTextNode(option.name));
            select.appendChild(element);
        });


    });
};

main();

console.log(listOptions);
