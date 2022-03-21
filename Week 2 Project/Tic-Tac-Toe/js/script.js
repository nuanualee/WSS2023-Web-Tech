var currentPlayer = "X"
console.log("The current player is", currentPlayer)
// Available TTT combo
combination =  ["1","2","3"],
                ["4","5","6"],
                ["7","8","9"],
                ["1","5","9"],
                ["3","5","7"],
                ["1","4","7"],
                ["2","5","8"],
                ["3","6","9"] 
comboX = []

// display current player turn to play the board
$(".grid").on("click", function(){
    document.getElementById("currentPlayer").innerHTML = currentPlayer + " Turn"

    // find closest grid class
    var currentGrid=$(this).closest(".grid"); // closest table row
    // console.log(currentGrid.text())
    if (currentGrid.text() === ""){ 
        currentGrid.text(currentPlayer)
        currentPlayer = currentPlayer === "X" ? "O" : "X" 
    document.getElementById("currentPlayer").innerHTML = currentPlayer + " Turn"

    }

    

    currentGrid.innerHTML = "currentPlayer"
    document.getElementsByClassName("grid").innerHTML = currentPlayer
    // console.log(currentGrid)

    currentComboX = ["", "", ""]
    currentComboO = ["", "", ""]
    console.log(this.dataset.id)




    if (currentPlayer === "X"){
        console.log("O pressed")
        $("#X").prop("disabled", false)
        $("#O").prop("disabled", true)
       
    } else {
        console.log("X pressed")
        $("#X").prop("disabled", true)
        $("#O").prop("disabled", false)

        
        if ("currentComboX" in localStorage){
            // if key exists
            // comboX = JSON.parse(retrieveX)
            comboX.push(this.dataset.id)
            console.log(comboX)

            console.log(combination.includes(["1","2","3"]))
            // alert(comboX)
            // localStorage.setItem("currentComboX", JSON.stringify(comboX))
        } else {
            comboX.push(this.dataset.id)
            // localStorage.setItem("currentComboX", this.dataset.id)
        }

    }
})






