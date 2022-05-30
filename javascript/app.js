if (document.readyState == 'loading') {
    //listen to when will it load then call the method ready
    //it will wait for the page to load before it call this method
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}
//this method will make the button works even if the the page is not loaded
function ready() {
    var countAnswers = 0;
    place1 = document.getElementsByClassName('place-here')[0]
    place2 = document.getElementsByClassName('place-here')[1]
    place3 = document.getElementsByClassName('place-here')[2]

    console.log(place1.children[1].classList[0])
    var itemsInStorage = JSON.parse(window.localStorage.getItem('answer'))
    if (itemsInStorage != null) {

        for (var i = 0; i < itemsInStorage.length; i++) {

            if (itemsInStorage[i].classList[0] === place1.children[1].classList[0]) {
                place1.children[1].classList.add('dropped')
                place1.children[1].style.backgroundColor = itemsInStorage[i].color2
                console.log('it is : ' + itemsInStorage[i].color2)
                if (itemsInStorage[i].color2 == '#D5ECE2') {
                    place1.children[1].classList.add('correct')
                    countAnswers += 1;
                }
                place1.children[0].style.backgroundColor = itemsInStorage[i].color1
                place1.children[1].children[0].innerText = itemsInStorage[i].text
                place1.children[1].children[0].style.color = itemsInStorage[i].textColor
                place1.children[1].children[1].setAttribute('value', itemsInStorage[i].text)
                document.getElementById(place1.children[1].children[0].innerText).classList.add('invisible')
            }

            if (itemsInStorage[i].classList[0] === place2.children[1].classList[0]) {
                place2.children[1].classList.add('dropped')
                place2.children[1].style.backgroundColor = itemsInStorage[i].color2
                if (itemsInStorage[i].color2 == '#D5ECE2') {
                    place2.children[1].classList.add('correct')
                    countAnswers += 1;
                }
                place2.children[0].style.backgroundColor = itemsInStorage[i].color1
                place2.children[1].children[0].innerText = itemsInStorage[i].text
                place2.children[1].children[0].style.color = itemsInStorage[i].textColor
                place2.children[1].children[1].setAttribute('value', itemsInStorage[i].text)
                document.getElementById(place2.children[1].children[0].innerText).classList.add('invisible')
            }

            if (itemsInStorage[i].classList[0] === place3.children[1].classList[0]) {
                place3.children[1].classList.add('dropped')
                place3.children[1].style.backgroundColor = itemsInStorage[i].color2
                if (itemsInStorage[i].color2 == '#D5ECE2') {
                    place3.children[1].classList.add('correct')
                    countAnswers += 1;
                }
                place3.children[0].style.backgroundColor = itemsInStorage[i].color1
                place3.children[1].children[0].innerText = itemsInStorage[i].text
                place3.children[1].children[0].style.color = itemsInStorage[i].textColor
                place3.children[1].children[1].setAttribute('value', itemsInStorage[i].text)
                document.getElementById(place3.children[1].children[0].innerText).classList.add('invisible')
            }
        }
        if (countAnswers == 3) {
            document.getElementById("submit-button").disabled = true;
            document.getElementById("submit-button").style.backgroundColor = 'gray';
            setTimeout(function() { mabrouk(); }, 1000);
        }
    }
}

const draggableElements = document.querySelectorAll(".option");
const droppableElements = document.querySelectorAll(".place-here");

draggableElements.forEach(elem => {
    elem.addEventListener("dragstart", dragStart); // Fires as soon as the user starts dragging an item - This is where we can define the drag data
    // elem.addEventListener("drag", drag); // Fires when a dragged item (element or text selection) is dragged
    // elem.addEventListener("dragend", dragEnd); // Fires when a drag operation ends (such as releasing a mouse button or hitting the Esc key) - After the dragend event, the drag and drop operation is complete
});

droppableElements.forEach(elem => {
    elem.addEventListener("dragenter", dragEnter); // Fires when a dragged item enters a valid drop target
    elem.addEventListener("dragover", dragOver); // Fires when a dragged item is being dragged over a valid drop target, repeatedly while the draggable item is within the drop zone
    elem.addEventListener("dragleave", dragLeave); // Fires when a dragged item leaves a valid drop target
    elem.addEventListener("drop", drop); // Fires when an item is dropped on a valid drop target
    elem.addEventListener("click", clicked);
});



function dragStart(event) {
    event.dataTransfer.setData("text", event.target.getAttribute('id')); // or "text/plain" but just "text" would also be fine since we are not setting any other type/format for data value
}

//Events fired on the drop target

function dragEnter(event) {
    // if (!event.target.classList.contains("dropped")) {
    //     event.target.classList.add("droppable-hover");
    // }
}

function dragOver(event) {
    if (!event.target.classList.contains("dropped")) {
        event.preventDefault(); // Prevent default to allow drop
    }
}

function dragLeave(event) {
    if (!event.target.classList.contains("dropped")) {
        event.target.classList.remove("droppable-hover");
    }
}

let storedItems = []

function drop(event) {

    var itemsInStorage = JSON.parse(window.localStorage.getItem('answer'))
    if (itemsInStorage == null) {
        itemsInStorage = []
    }


    event.preventDefault(); // This is in order to prevent the browser default handling of the data

    const draggableElementData = event.dataTransfer.getData("text"); // Get the dragged data. This method will return any data that was set to the same type in the setData() method
    // console.log(draggableElementData)
    //const droppableElementData = event.target.getAttribute("name");
    // console.log(event.target)
    // if (draggableElementData === droppableElementData) {
    const wholeElement = event.target.parentElement.children[0];
    wholeElement.style.backgroundColor = '#C698C7';
    event.target.style.backgroundColor = '#FFF8FE';
    event.target.children[0].innerText = draggableElementData;
    event.target.children[0].style.color = '#C878CF';
    event.target.children[1].setAttribute('value', draggableElementData)
    event.target.classList.add("dropped");
    const dragged = document.getElementById(draggableElementData);
    dragged.classList.add("invisible");
    //wholeElement.setAttribute("draggable", "false");

    var itemObj = {
        classList: event.target.classList, //classlist[0] = placeId
        color1: '#C698C7',
        color2: '#FFF8FE',
        text: draggableElementData, //the id of option
        textColor: '#C878CF'
    };

    console.log(itemObj.classList)
        //store each object in an array
    itemsInStorage.push(itemObj)
    window.localStorage.setItem('answer', JSON.stringify(itemsInStorage));


}

function clicked(event) {
    console.log('clicked')
    console.log("even target: " + event.target.classList)
    if (!event.target.classList.contains('correct')) {
        //remove form local storage
        //get the number of items in the array of item objects
        var count = JSON.parse(window.localStorage.getItem('answer')).length
            //get the array
        var temp = JSON.parse(window.localStorage.getItem('answer'))
            // treverse until you find an item with the same name
        for (var i = 0; i < count; i++) {
            console.log(temp[i].classList)
            if (temp[i].classList[0] === event.target.classList[0]) {
                //delete it
                console.log('deleted')
                temp.splice(i, 1);

            }
            //set the global variable to local variable
            storedItems = temp
                //update local storage
            window.localStorage.setItem('answer', JSON.stringify(temp));
        }

        event.preventDefault();
        const wholeElement = event.target.parentElement.children[0];
        console.log(event.target)
        wholeElement.style.backgroundColor = '#C9C8C8';
        event.target.style.backgroundColor = '#E5E5E5';
        const id = event.target.children[0].innerText;
        event.target.children[0].innerText = '';
        event.target.children[0].style.color = '#C878CF';
        event.target.children[1].setAttribute('value', '')
        event.target.classList.remove("dropped");
        console.log(event.target)
            // event.target.classList.add("dropped");
        const dragged = document.getElementById(id);
        dragged.classList.remove("invisible");
        // wholeElement.setAttribute("draggable", "false");
    }
}

function mabrouk() {
    document.getElementById("next-page").style.display = 'block';
}