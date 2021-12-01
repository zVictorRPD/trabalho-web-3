/* customização do css */
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select-2":*/
x = document.getElementsByClassName("custom-select-2");
l = x.length;
for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
        /*for each option in the original select element,
        create a new DIV that will act as an option item:*/
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function (e) {
            /*when an item is clicked, update the original select box,
            and the selected item:*/
            var y, i, k, s, h, sl, yl;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            sl = s.length;
            h = this.parentNode.previousSibling;
            for (i = 0; i < sl; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");
                    yl = y.length;
                    for (k = 0; k < yl; k++) {
                        y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                }
            }
            h.click();
        });
        b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function (e) {
        /*when the select box is clicked, close any other select boxes,
        and open/close the current select box:*/
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i)
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);


class popupAlert {
    constructor(message, type, time = null) {
        this.message = message;
        this.type = type;
        this.time = time;
    }
    create() {
        const popup = document.createElement('div');
        const icon = document.createElement('i');
        if (this.type == 1) {
            popup.className = 'popup';
            icon.className = 'far fa-check-circle icon';

        }else if(this.type == 2){
            popup.className = 'popup-alert';
            icon.className = 'fas fa-exclamation icon';
        }


        const header = document.createElement('div');
        header.className = 'popup-header';

        const div_close = document.createElement('div');
        div_close.className = 'popup-close';
        const img_close = document.createElement('i');
        img_close.className = 'fas fa-times';

        div_close.appendChild(img_close);
        div_close.addEventListener('click', () => {
            popup.remove();
        });

        header.appendChild(icon);
        header.appendChild(div_close);

        const message = document.createElement('div');
        message.className = 'popup-body';
        message.innerText = this.message;

        const progress = document.createElement('div');
        progress.className = 'popup-progress';

        popup.appendChild(header);
        popup.appendChild(message);
        popup.appendChild(progress);

        document.getElementById('alerts').appendChild(popup);
        document.getElementById('alerts').style.zIndex = 10000;

        var width = 100;
        var progress_running = setInterval(progressRun, (this.time / 100));
        function progressRun() {
            if (width <= 0) {
                clearInterval(progress_running);
                popup.remove();
            } else {
                width--;
                progress.style.width = `${width}%`;
            }
        }
    }
}
