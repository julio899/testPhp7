// Event animation btn-add
var countBtns = document.getElementsByClassName('btn-add').length;
var Totals = 0;
var StarsEdition = 0;
var productInEdition = 0;
var TruckCost = 0;
var starSelected = false;
var baseURI = document.getElementById('baseURI').value;
bagedTruck = document.getElementById('baged-truck');
bagedTotal = document.getElementById('baged-total');
// set truck to pickup cost $0
document.getElementById('pickup').classList.add('cartAdd');
// init tooltips
setTimeout(() => {
    $('[data-toggle="tooltip"]').tooltip({
        "tigger": "hover focus"
    });
    if (document.body.getElementsByTagName('div')[0].innerHTML.includes('This page is hosted')) {
        document.body.getElementsByTagName('div')[0].innerHTML = '';
        document.body.getElementsByClassName('cbalink')[0].innerHTML = '';
    } else if (document.body.getElementsByTagName('div')[1].innerHTML.includes('This page is hosted')) {
        document.body.getElementsByTagName('div')[1].innerHTML = '';
        document.body.getElementsByClassName('cbalink')[0].innerHTML = '';
    }
    checkIfExistCart();
}, 1000);
bagedTruck.innerText = '$ ' + parseFloat(TruckCost).toFixed(2);
bagedTotal.innerText = '$ ' + parseFloat(Totals).toFixed(2);
var btnAddEnable = true;
for (var i = 0; i < countBtns; i++) {
    document.getElementsByClassName('btn-add').item(i).addEventListener('click', (evt) => {
        if (btnAddEnable) {
            evt.preventDefault();
            var containerCartList = document.getElementById('container-cart-list');
            var btnAdd = evt.currentTarget;
            btnAdd.offsetParent.classList.add('animated', 'heartBeat', 'sobreposition');
            // New iten to add
            var newIten = document.createElement('a');
            newIten.innerHTML = '<label class="pull-left">' + btnAdd.getAttribute('data-name') + '</label>  <span class="badge badge-success badge-pill">$' + btnAdd.getAttribute('data-price') + '</span> <span class="badge badge-dark badge-pill menos" data-price="' + btnAdd.getAttribute('data-price') + '" onclick="removeIten(this)"><i class="fas fa-times"></i></span>';
            newIten.href = '#';
            newIten.setAttribute('data-name', btnAdd.getAttribute('data-name'));
            newIten.setAttribute('data-price', btnAdd.getAttribute('data-price'));
            newIten.setAttribute('data-id', btnAdd.getAttribute('data-id'));
            newIten.classList.add('dropdown-item', 'new-iten-add');
            newIten.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
            });
            Totals = parseFloat(parseFloat(Totals) + parseFloat(btnAdd.getAttribute('data-price'))).toFixed(2);
            containerCartList.prepend(newIten);
            bagedTotal.innerText = '$ ' + Totals;
            document.getElementById('cartIcon').classList.add('animated', 'wobble', 'cartAdd');
            setTimeout(() => {
                btnAdd.classList.remove('animated', 'wobble');
                btnAdd.offsetParent.classList.remove('animated', 'heartBeat', 'sobreposition');
                document.getElementById('cartIcon').classList.remove('animated', 'wobble', 'cartAdd');
            }, 1000);
            btnAddEnable = false;
            setTimeout(() => {
                btnAddEnable = true;
            }, 1000);
        }
    });
}
var upsCheck = false;
var pickupActive = true;
//Events pickup
document.getElementById('pickupContainer').addEventListener('click', (evt) => {
    if (pickupActive) {
        evt.preventDefault();
        var idName = '';
        // # Mozilla
        if (evt.originalTarget != undefined) {
            if (evt.originalTarget.localName == 'svg') {
                idName = evt.originalTarget.id;
            } else if (evt.originalTarget.localName == 'path') {
                idName = evt.originalTarget.farthestViewportElement.id;
            }
        } else {
            // # Chrome
            if (evt.target.localName == 'svg') {
                idName = evt.target.id;
            } else if (evt.target.localName == 'path') {
                idName = evt.target.farthestViewportElement.id;
            }
        }
        if (idName === 'ups' && !upsCheck) {
            Totals = parseFloat(parseFloat(Totals) + 5);
            bagedTruck.innerText = '$' + parseFloat(5).toFixed(2);
            upsCheck = true;
        } else if (idName !== 'ups' && upsCheck && Totals > 0) {
            Totals = parseFloat(parseFloat(Totals) - 5);
            bagedTruck.innerText = '$' + parseFloat(0).toFixed(2);
            upsCheck = false;
        }
        bagedTotal.innerText = '$ ' + parseFloat(Totals).toFixed(2);
        console.log(idName, Totals);
        if (idName == 'pickup') {
            localStorage.setItem('truck', 0.00);
            bagedTruck.innerText = '$ 0';
            if (document.getElementsByClassName('new-iten-add').length = 0) {
                Totals = 0;
                bagedTotal.innerText = '$ ' + Totals;
            }
        } else {
            localStorage.setItem('truck', 5.00);
            bagedTruck.innerText = '$ 5';
        }
        document.getElementById('ups').classList.remove('cartAdd');
        document.getElementById('pickup').classList.remove('cartAdd');
        if (idName != '') {
            document.getElementById(idName).classList.add('cartAdd');
        }
        $('#' + idName).tooltip('hide');
        setTimeout(() => {
            $('.dropdown-toggle').dropdown('show');
            $('[data-toggle="tooltip"]').tooltip({
                "tigger": "hover focus"
            });
        }, 100);
        pickupActive = false;
    }
    setTimeout(() => {
        pickupActive = true;
    }, 1000);
});
var enableBtnCart = true;
// Event Btn
document.getElementById('touch-cart-list').addEventListener('click', (e) => {
    if (enableBtnCart) {
        //    $('#touch-cart-list').dropdown('show');
        enableBtnCart = false;
        setTimeout(() => {
            enableBtnCart = true;
        }, 1000);
    }
});
var enableBtnPay = true;
//Event click to btn-pay
document.querySelector('#btn-pay').addEventListener('click', debounce(function() {
    if (document.getElementsByClassName('new-iten-add').length == 0) {
        alertify.alert('We are Sorry', 'Your need add some item to the cart!', function() {
            alertify.success('Cart is Empty');
        });
    } else {
        var cart = [];
        for (var i = 0; i < document.getElementsByClassName('new-iten-add').length; i++) {
            var currentIten = document.getElementsByClassName('new-iten-add').item(i);
            cart.push({
                "name": currentIten.getAttribute('data-name'),
                "price": currentIten.getAttribute('data-price'),
                "id": currentIten.getAttribute('data-id')
            });
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        localStorage.setItem('truck', parseFloat(bagedTruck.innerText.replace('$', '')).toFixed(2));
        if (document.getElementById('isLog') != null && document.getElementById('isLog').value == "true") {
            // # Display the Loader 
            document.getElementById('loader').classList.remove('no-display');
            var headers = new Headers();
            headers.append('Accept', 'application/json');
            headers.append('Content-Type', 'application/x-www-form-urlencoded');
            fetch('processing', {
                method: 'POST',
                credentials: 'include',
                headers: headers,
                body: JSON.stringify({
                    cart
                }),
            }).then(resp => {
                resp.json().then((response) => {
                    // # Hidden the Loader 
                    document.getElementById('loader').classList.add('no-display');
                    console.log(response);
                    if (response.status == 'OK') {
                        alertify.alert('Success', 'Processing Successinfull!', function() {
                            alertify.success('Refresh Data');
                            localStorage.setItem('cart', JSON.stringify([]));
                            localStorage.setItem('truck', 0);
                            setTimeout(() => {
                                window.location.href = 'http://' + window.location.hostname + '' + window.location.pathname;
                            }, 1000);
                        });
                    } else if (response.status == 'CANCEL') {
                        alertify.error(response.msg);
                    }
                });
            }).catch(err => {
                //  ...
            })
        } else {
            alertify.alert('Hey Excellent, congratulations you first step', 'But, Is needed Login!', function() {
                alertify.success('Auhtentication');
                if (window.location.hostname.includes('localhost')) {
                    window.location.href = 'http://' + window.location.hostname + '' + window.location.pathname.replace('home', '') + 'login';
                } else {
                    window.location.href = 'http://' + window.location.hostname + '/' + 'login';
                }
            });
        }
    }
}, 250));
var enableRemove = true;

function updateCart(newCart) {
    localStorage.setItem('cart', JSON.stringify(newCart));
    localStorage.setItem('truck', parseFloat(bagedTruck.innerText.replace('$', '')).toFixed(2));
}

function removeIten(evt) {
    if (enableRemove) {
        if (parseFloat(Totals).toFixed(2) > parseFloat(evt.getAttribute('data-price')).toFixed(2)) {
            Totals = parseFloat(Totals).toFixed(2) - parseFloat(evt.getAttribute('data-price')).toFixed(2);
        } else {
            Totals = 0;
        }
        bagedTotal.innerText = '$ ' + parseFloat(Totals).toFixed(2);
        console.log(evt.parentElement);
        evt.parentElement.classList.add('animated', 'flipOutX');
        if (localStorage.getItem('cart') != null) {
            var is_removed = false;
            var cart = JSON.parse(localStorage.getItem('cart'));
            var cart_up = []
            cart.map((iten) => {
                if (iten.id != undefined && iten.id === evt.parentElement.getAttribute('data-id') && !is_removed) {
                    is_removed = true;
                } else {
                    cart_up.push(iten);
                }
            });
            updateCart(cart_up);
        }
        // $('.dropdown-toggle').dropdown('show');        
        $('#touch-cart-list').dropdown('show');
        setTimeout(() => {
            // add delay of efect
            evt.parentElement.remove();
        }, 700);
        enableRemove = false;
    }
    setTimeout(() => {
        enableRemove = true;
    }, 1100);
}

function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this,
            args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

function checkIfExistCart() {
    if (localStorage.getItem('cart') != null) {
        var cart = JSON.parse(localStorage.getItem('cart'));
        Totals = 0;
        cart.map((iten) => {
            if (iten.id != undefined) {
                var containerCartList = document.getElementById('container-cart-list');
                // New iten to add
                var newIten = document.createElement('a');
                newIten.innerHTML = '<label class="pull-left">' + iten.name + '</label>  <span class="badge badge-success badge-pill">$' + iten.price + '</span> <span class="badge badge-dark badge-pill menos" data-price="' + iten.price + '" onclick="removeIten(this)"><i class="fas fa-times"></i></span>';
                newIten.href = '#';
                newIten.setAttribute('data-name', iten.name);
                newIten.setAttribute('data-price', iten.price);
                newIten.setAttribute('data-id', iten.id);
                newIten.classList.add('dropdown-item', 'new-iten-add');
                containerCartList.prepend(newIten);
                Totals = parseFloat(Totals) + parseFloat(iten.price);
            }
        });
    }
    if (localStorage.getItem('truck') != null) {
        if (parseFloat(localStorage.getItem('truck')) > 0) {
            console.log('changed icons Truck')
            document.getElementById('ups').classList.add('cartAdd');
            document.getElementById('pickup').classList.remove('cartAdd');
        }
        Totals = parseFloat(Totals) + parseFloat(localStorage.getItem('truck'));
        bagedTruck.innerText = '$ ' + localStorage.getItem('truck');
    }
    bagedTotal.innerText = '$ ' + parseFloat(Totals).toFixed(2);
}

function getCommentaries(pID) {
    var listCommentaries = document.getElementById('list-commentaries');
    listCommentaries.classList.add('no-display');
    var headers = new Headers();
    headers.append('Accept', 'application/json');
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    fetch('getCommentaries', {
        method: 'POST',
        credentials: 'include',
        headers: headers,
        body: JSON.stringify({
            id: pID
        }),
    }).then(resp => {
        // # Hidden the Loader 
        loaderOff();
        listCommentaries.classList.remove('no-display');
        listCommentaries.innerHTML = '';
        listCommentaries.classList.remove('no-display');
        resp.json().then((commentaries) => {
            commentaries.forEach((Comment) => {
                var span = document.createElement('span');
                span.innerHTML = '<i class="fas fa-star star-yellow"></i> ' + Comment.stars;
                var spanDate = document.createElement('span');
                spanDate.innerText = Comment.date;
                spanDate.classList.add('badge', 'badge-light', 'badge-pill');
                var li = document.createElement('li');
                li.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                li.innerText = Comment.commentary;
                li.append(span);
                listCommentaries.append(li);
            });
            if (commentaries.length == 0) {
                var li = document.createElement('li');
                li.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                li.innerText = 'Sorry, but this product, no has comments in this moment';
                listCommentaries.append(li);
            }
        });
    }).catch(err => {
        alertify.error(err);
    });
}

function activateStar(star) {
    var numberStar = parseInt(star.getAttribute('id').replace('star', ''));
    for (var i = 5; i >= 1; i--) {
        document.getElementById('star' + i).classList.add('far');
        document.getElementById('star' + i).classList.remove('fas', 'star-yellow', 'animated', 'rubberBand');
    }
    for (var i = 1; i <= 5; i++) {
        if (i <= numberStar) {
            document.getElementById('star' + i).classList.add('fas', 'star-yellow');
        }
    }
    StarsEdition = numberStar;
    star.classList.add('animated', 'rubberBand');
}

function loaderOff() {
    var countLoaders = document.getElementsByClassName('loader2').length;
    for (var c = 0; c < countLoaders; c++) {
        document.getElementsByClassName('loader2').item(c).classList.add('no-display');
        console.log(c);
    }
}

function modCalcification(element) {
    productInEdition = parseInt(element.getAttribute('data-product-id'));
    document.getElementById('comment-edit').value = element.getAttribute('data-commentary');
    var numberStar = parseInt(element.getAttribute('data-stars'));
    StarsEdition = numberStar;
    for (var i = 1; i <= 5; i++) {
        if (i <= numberStar) {
            document.getElementById('star' + i).classList.add('fas', 'star-yellow');
        }
    }
    loaderOff();
}

function modCalcificationM(element) {
    starSelected = false;
    productInEdition = parseInt(element.getAttribute('data-product-id'));
    document.getElementById('comment-edit-m').value = '';
    for (var i = 1; i <= 5; i++) {
        document.getElementById('starM' + i).classList.remove('far', 'fas', 'star-yellow');
        document.getElementById('starM' + i).classList.add('far');
    }
    loaderOff();
}

function sendStars() {
    if (!starSelected) {
        alertify.warning('Yours need selected some Star.');
    } else {
        loaderOff();
        var data = {
            "stars": StarsEdition,
            "comment": document.getElementById('comment-edit-m').value,
            "idProduct": productInEdition
        };
        console.log(data);
        var headers = new Headers();
        headers.append('Accept', 'application/json');
        headers.append('Content-Type', 'application/x-www-form-urlencoded');
        fetch('sendStars', {
            method: 'POST',
            credentials: 'include',
            headers: headers,
            body: JSON.stringify(data),
        }).then(resp => {
            // # Hidden the Loader 
            loaderOff();
            resp.json().then((dataResp) => {
                console.log(dataResp);
                if (dataResp.status == 'OK') {
                    $('#make-calcification').modal('hide');
                    alertify.success('Load is completed success');
                    alertify.alert('Congratulations!', 'Your qualification has been successfully loaded.', function() {
                        window.location.href = 'http://' + window.location.hostname + '' + window.location.pathname;
                    });
                }
            });
        }).catch(err => {
            alertify.error(err);
        });
        /*
         */
    }
}

function activateStarM(star) {
    starSelected = true;
    var numberStar = parseInt(star.getAttribute('id').replace('starM', ''));
    for (var i = 5; i >= 1; i--) {
        document.getElementById('starM' + i).classList.add('far');
        document.getElementById('starM' + i).classList.remove('fas', 'star-yellow', 'animated', 'rubberBand');
    }
    for (var i = 1; i <= 5; i++) {
        if (i <= numberStar) {
            document.getElementById('starM' + i).classList.add('fas', 'star-yellow');
        }
    }
    StarsEdition = numberStar;
    star.classList.add('animated', 'rubberBand');
}

function updateStar() {
    console.log('updateStar');
    var data = {
        "stars": StarsEdition,
        "comment": document.getElementById('comment-edit').value,
        "idProduct": productInEdition
    };
    var headers = new Headers();
    headers.append('Accept', 'application/json');
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    fetch('updateStar', {
        method: 'POST',
        credentials: 'include',
        headers: headers,
        body: JSON.stringify(data),
    }).then(resp => {
        // # Hidden the Loader 
        loaderOff();
        resp.json().then((dataResp) => {
            console.log(dataResp);
            if (dataResp.status == 'OK') {
                $('#calcificationStar').modal('hide');
                alertify.success('update completed success');
                alertify.alert('Congratulations!', 'Your qualification has been successfully loaded.', function() {
                    window.location.href = 'http://' + window.location.hostname + '' + window.location.pathname;
                });
            }
        });
    }).catch(err => {
        alertify.error(err);
    });
}