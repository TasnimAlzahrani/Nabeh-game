if (document.readyState == 'loading') {
    //listen to when will it load then call the method ready
    //it will wait for the page to load before it call this method
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}
const options = document.querySelectorAll(".options");

//this method will make the button works even if the the page is not loaded
function ready() {

    var numbersInStorage = JSON.parse(window.localStorage.getItem('answerID'))
    if (numbersInStorage != null) {
        for (var i = 0; i < numbersInStorage.length; i++) {
            // numbers.push(numbersInStorage[i])
            const elm = document.getElementById(numbersInStorage[i])
            elm.children[1].style.backgroundColor = '#4D7D7B';
            elm.children[1].children[0].style.color = '#fff';
        }
    }
}

options.forEach(elem => {
    elem.addEventListener("click", clicked);
});

function clicked(event) {
    const option = event.target
    var numbers = JSON.parse(window.localStorage.getItem('answerID'))
    if (numbers == null) {
        numbers = []
    }
    if (option.classList[0] == 'text') {
        //store id in an array
        const id = option.parentElement.parentElement.getAttribute('id')

        if (numbers.indexOf(id) == -1) {
            option.style.color = '#fff';
            option.parentElement.style.backgroundColor = '#4D7D7B';
            numbers.push(option.parentElement.parentElement.getAttribute('id'));
        } else {
            option.style.color = '#4D7D7B';
            option.parentElement.style.backgroundColor = '#CFE2DE';

            var count = JSON.parse(window.localStorage.getItem('answerID')).length
                //get the array
            var temp = JSON.parse(window.localStorage.getItem('answerID'))
                // treverse until you find an item with the same name
            for (var i = 0; i < count; i++) {
                console.log(temp[i])
                if (temp[i] === id) {
                    //delete it
                    console.log('deleted')
                    temp.splice(i, 1);

                }
                //set the global variable to local variable
                numbers = temp
                    //update local storage
                    //window.localStorage.setItem('answerID', JSON.stringify(temp));
            }
        }

    } else {
        option.style.backgroundColor = '#4D7D7B';
        option.children[0].style.color = '#fff';
        numbers.push(option.parentElement.getAttribute('id'));
    }

    window.localStorage.setItem('answerID', JSON.stringify(numbers));
}


function checkAnswer() {
    var numbersInStorage = JSON.parse(window.localStorage.getItem('answerID'))
    var count = 0;
    if (numbersInStorage.length < 3) {
        console.log('nothing')
    } else {
        console.log('1')
            // 2 3 6
        temp = numbersInStorage
        var elm = '';
        if (temp.indexOf('2') != -1) {
            elm = document.getElementById('2')
            elm.children[1].style.backgroundColor = '#8BE4CF';
            elm.children[1].children[0].style.color = '#4D7D7B';
            temp[temp.indexOf('2')] = ''
            count += 1;
        }
        if (temp.indexOf('3') != -1) {
            elm = document.getElementById('3')
            elm.children[1].style.backgroundColor = '#8BE4CF';
            elm.children[1].children[0].style.color = '#4D7D7B';
            temp[temp.indexOf('3')] = ''
            count += 1;
            console.log('good')
        }
        if (temp.indexOf('6') != -1) {
            elm = document.getElementById('6')
            elm.children[1].style.backgroundColor = '#8BE4CF';
            elm.children[1].children[0].style.color = '#4D7D7B';
            temp[temp.indexOf('6')] = ''
            count += 1;

        }
        for (var i = 0; i < temp.length; i++) {
            if (temp[i] != '') {
                elm = document.getElementById(temp[i])
                elm.children[1].style.backgroundColor = '#E2D9CF';
                elm.children[1].children[0].style.color = '#7D4D4D';
            }
        }


        if (count != 3) {
            var points = parseInt(document.getElementById('point').innerText)
            document.getElementById('point').innerText = points - 1
        } else {
            var points = parseInt(document.getElementById('point').innerText)
            document.getElementById('point').innerText = points + 10
                // document.getElementById('next').disabled = 'false'
                // document.getElementById('next').style.backgroundColor = '#c8e1e1';
            setTimeout(function() { mabrouk(); }, 1000);
        }


        // celebrate and go to next page
    }
}

function mabrouk() {

    document.getElementById("next-page").style.display = 'block';
}