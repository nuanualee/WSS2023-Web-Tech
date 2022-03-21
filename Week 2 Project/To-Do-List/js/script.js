// setting initial dummy to do data list
var todo = [{
    "name": "homework",
    "category": "work",
    "deadline": "2022-03-22"
},{
    "name": "presentation",
    "category": "schoolwork",
    "deadline": "2023-04-22"
},]

const btn = document.getElementById("button")

// if localstorage key data is null, set the data from our dummy data
if(localStorage.getItem("data") === ""){
    localStorage.setItem('data', JSON.stringify(todo));
}
// access localstorage by key data
var retrieveData = localStorage.getItem('data');
// parse string back to array object
var dataObject = JSON.parse(retrieveData)

// build the table and pass in dataObject
buildTable(dataObject)

// function to build table, accepts 1 arg
function buildTable(data){
    var table = document.getElementById("tableData")
    // counter for number increment
    var counter = 0
    // set table to become empty
    table.innerHTML  = ""
    for (var i = 0; i < data.length; i++) {
            counter++
            var row = `<tr>
                            <td value="${data[i].name}">${data[i].name}</td> 
                            <td value="${data[i].category}">${data[i].category}</td>
                            <td value="${data[i].deadline}">${data[i].deadline}</td>
                            <td id="${counter}" class="edit">&#10000</td>
                            <td class="delete">&#10006</td>
                        </tr>`
        table.innerHTML += row 
    }
}

// target edit button on each row inside table
$("#tableData").on("click", ".edit", function(){

    var currentRow=$(this).closest("tr"); // closest table row
    console.log(currentRow)
    var name=currentRow.find("td:eq(0)").text(); // 1st td val
    var haha=currentRow.find("td:eq(0)"); // 1st td val
    


    var category=currentRow.find("td:eq(1)").text(); // 2nd td val
    var deadline=currentRow.find("td:eq(2)").text();// 3rd td val

    document.getElementById("add").value = name // get value of to do name and assign to var name
    document.getElementById("category").value = category // get value of to do category and assign to var category
    document.getElementById("deadline").value = deadline // get value of to do deadline and assign to var deadline


    document.getElementById("add").focus() // focus user back to add input

    if (document.getElementById("button").innerHTML != null){ // if button div is not empty
        document.getElementById("button").innerHTML = "" // set it to become empty
        document.getElementById('tableData').onclick = null // nullify tabledata
        document.getElementById('add').onclick = null // add button will be gone 
    }

    localStorage.setItem("name", name) // set name of to do name inside local storage

    document.getElementById("textdate").style.display = "block" 
    btn.insertAdjacentHTML("afterbegin", "<div class='row justify-content-center'><button onclick='updateData()' type='button' class='btn btn-warning'>Update</button></div>");
         
})

function updateData(){
    // init index, to access array by its positioning 
    const index = dataObject.findIndex(item => item.name === localStorage.getItem("name"));
    
    dataObject[index].name = document.getElementById("add").value
    dataObject[index].category = document.getElementById("category").value
    dataObject[index].deadline = document.getElementById("deadline").value


    if(!localStorage.getItem("data") == ""){

        localStorage.clear();
        localStorage.setItem('data', JSON.stringify(dataObject));

        buildTable(dataObject)
    }
    
}

// delete data
$("#tableData").on("click", ".delete", function(){
    if (window.confirm("Do you want to delete this item?")) {
        var currentRow=$(this).closest("tr"); // closest table row

        var name=currentRow.find("td:eq(0)").text(); // 1st td val
        localStorage.setItem("name", name)
        const index = dataObject.findIndex(item => item.name === localStorage.getItem("name"));
        dataObject.splice(index, 1)
        console.log(dataObject)
        if(!localStorage.getItem("data") == ""){
    
            localStorage.clear();
            localStorage.setItem('data', JSON.stringify(dataObject));
    
            buildTable(dataObject)
        }
    }
   
   
})

// order by name, category & deadline
$("th").on("click", function(){
    var column = $(this).data("column")
    var order = $(this).data("order")
    console.log("clicked", column, order)
    var arrow = $(this).html()
    arrow = arrow.substring(0, arrow.length-1)

    // check order if it is asc or desc
    if (order == "desc"){
        $(this).data("order", "asc")
        dataObject = dataObject.sort((a,b)=> a[column] > b[column] ? 1 : -1)
        arrow += "&#9660"
    } else {
        $(this).data("order", "desc")
        dataObject = dataObject.sort((a,b)=> a[column] < b[column] ? 1 : -1)
        arrow += "&#9650"
    }
    $(this).html(arrow)
    buildTable(dataObject)
})

// filter by name
$("#filter-search").on("keyup", function(){
    var value = $(this).val()
    console.log("value", value)
    var mydata = filterSearch(value, dataObject)

   if (mydata.length == 0) {
        console.log("no search found")
        alert("No Search reuslt") 
    } else {
        buildTable(mydata)
    }
})


function filterSearch(input, data){

    var filteredData = []

    // loop through array and add value that matches search input 
    for (var i = 0; i < data.length; i++) {
        input = input.toLowerCase()
        var name = data[i].name.toLowerCase()
        // var table = document.getElementById("tableData")

        if (name.includes(input)){
            filteredData.push(data[i])
        } 
        
    }

    return filteredData
}

document.getElementById('add').onclick = function changeContent() {

    document.getElementById("textdate").style.display = "block"
    btn.insertAdjacentHTML("afterbegin", "<div class='row justify-content-center'><button onclick='submitData()' type='button' class='btn btn-primary'>Submit</button></div>");

    if (document.getElementById("button").innerHTML != null){
        document.getElementById('add').onclick = null
    }
}


function submitData(){
    var name = document.getElementById("add").value
        var category = document.getElementById("category").value
        var deadline = document.getElementById("deadline").value

        console.log(name, category, deadline)

        var newData = {
            "name": name,
            "category": category,
            "deadline": deadline
        }


        if(!localStorage.getItem("data") == ""){
            dataObject.push(newData)
            console.log("new", dataObject)

            localStorage.clear();
            localStorage.setItem('data', JSON.stringify(dataObject));

            var retrieveData = localStorage.getItem('data');
            buildTable(JSON.parse(retrieveData))
    }
}
