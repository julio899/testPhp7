// Event animation btn-add
var countBtns = document.getElementsByClassName('btn-add').length;
var Totals = 0;
var TruckCost = 0;
// set truck to pickup cost $0
document.getElementById('pickup').classList.add('cartAdd');
// init tooltips
setTimeout(() => {
    $('[data-toggle="tooltip"]').tooltip({
        "tigger": "hover focus"
    });
    if( document.body.getElementsByTagName('div')[0].innerHTML.includes('This page is hosted') )
    {
    	document.body.firstChild.innerHTML='';
    	document.body.getElementsByClassName('cbalink')[0].innerHTML='';
    }
}, 1000);
bagedTruck = document.getElementById('baged-truck');
bagedTruck.innerText = '$ ' + parseFloat(TruckCost).toFixed(2);
bagedTotal = document.getElementById('baged-total');
bagedTotal.innerText = '$ ' + parseFloat(Totals).toFixed(2);
for (var i = 0; i < countBtns; i++) {
    document.getElementsByClassName('btn-add').item(i).addEventListener('click', (evt) => {
        evt.preventDefault();
        var containerCartList = document.getElementById('container-cart-list');
        var btnAdd = evt.currentTarget;
        btnAdd.offsetParent.classList.add('animated', 'heartBeat');
        // New iten to add
        var newIten = document.createElement('a');
        newIten.innerHTML = '<label class="pull-left">' + btnAdd.getAttribute('data-name') + '</label>  <span class="badge badge-success badge-pill">$' + btnAdd.getAttribute('data-price') + '</span> <span class="badge badge-dark badge-pill menos" data-price="' + btnAdd.getAttribute('data-price') + '" onclick="removeIten(this)"><i class="fas fa-times"></i></span>';
        newIten.href = '#';
        newIten.classList.add('dropdown-item', 'new-iten-add');

        newIten.addEventListener('click',(e)=>{
        	e.preventDefault();
        	console.log(e);
        	console.log('epa');
        });

        Totals = parseFloat(parseFloat(Totals) + parseFloat(btnAdd.getAttribute('data-price'))).toFixed(2);
        containerCartList.prepend(newIten);
        bagedTotal.innerText = '$ ' + Totals;
        document.getElementById('cartIcon').classList.add('animated', 'wobble', 'cartAdd');
        setTimeout(() => {
            btnAdd.classList.remove('animated', 'wobble');
            btnAdd.offsetParent.classList.remove('animated', 'heartBeat');
            document.getElementById('cartIcon').classList.remove('animated', 'wobble', 'cartAdd');
        }, 1000);
    });
}
var upsCheck = false;
//Events pickup
document.getElementById('pickupContainer').addEventListener('click', (evt) => {
	evt.preventDefault();
    var idName = '';
    if (evt.originalTarget.localName == 'svg') {
        idName = evt.originalTarget.id;
    } else if (evt.originalTarget.localName == 'path') {
        idName = evt.originalTarget.farthestViewportElement.id;
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
    document.getElementById('ups').classList.remove('cartAdd');
    document.getElementById('pickup').classList.remove('cartAdd');
    document.getElementById(idName).classList.add('cartAdd');
    $('#' + idName).tooltip('hide')
    setTimeout(() => {
        $('.dropdown-toggle').dropdown('show');
        $('[data-toggle="tooltip"]').tooltip({
		        "tigger": "hover focus"
		    });
    }, 100);
});

function removeIten(evt)
{	
	Totals = parseFloat(Totals).toFixed(2) - parseFloat(evt.getAttribute('data-price')).toFixed(2);
    bagedTotal.innerText = '$ ' + parseFloat(Totals).toFixed(2);
	console.log(evt.parentElement);
	
	setTimeout(()=>{
		evt.parentElement.classList.add('animated', 'flipOutX');
        $('.dropdown-toggle').dropdown('show');
		setTimeout(()=>{
			// add delay of efect
			evt.parentElement.remove();
		},700);
	},100);
	return false;
}
