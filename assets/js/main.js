var operation = "";
var value = 0;
var newNumber = false;

function setNumber(number) {
    var result = document.getElementById('result');

    if (newNumber) {
        result.innerHTML = number;
        newNumber = false;
    } else {
        if (result.innerHTML === "0") {
            result.innerHTML = number;
        } else {
            result.innerHTML += number;
        }
    }
}

function setOperation(type) {
    var currentValue = parseFloat(document.getElementById('result').innerHTML);

    if (type === "equals") {
        if (operation !== "") {
            var result;

            switch (operation) {
                case "plus":
                    result = value + currentValue;
                    break;
                case "minus":
                    result = value - currentValue;
                    break;
                case "multiply":
                    result = value * currentValue;
                    break;
                case "divide":
                    result = currentValue !== 0 ? value / currentValue : "Error";
                    break;
            }

            document.getElementById('result').innerHTML = result;
            operation = "";
            value = 0;
            newNumber = true;
        }
        return;
    }

    if (type === "clear") {
        operation = "";
        value = 0;
        document.getElementById('result').innerHTML = "0";
        return;
    }

    value = currentValue;
    operation = type;
    newNumber = true;
}
