function validate(platenumber) {
    var letter = platenumber.slice(0, 3)
    var state1 = "invalid";
    var state2 = "invalid";
    var state3 = "invalid"
    if (isNaN(letter)) { //checks if its not a number 
        state1 = "valid"
    }
console.log( state1)
    var others = platenumber.slice(3, 6)
    if (!isNaN(others) && state1 == "valid") {
        state1 = "valid"
    }else{
        state1 = "invalid"
    }
console.log(state1)
    console.log(platenumber.slice(-1))
    if (isNaN(platenumber.slice(-1))&& state1 == "valid") {
       state1 = "valid"
    }
    else{
        state1 = "invalid"
    }
    console.log( state1)
  
}

