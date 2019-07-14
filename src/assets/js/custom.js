// Event animation btn-add
var countBtns = document.getElementsByClassName('btn-add').length;

for (var i = 0; i < countBtns ; i++) {
	document.getElementsByClassName('btn-add').item(i).addEventListener('click',(evt)=>{
		evt.preventDefault();
		var btnAdd = evt.currentTarget;
		btnAdd.offsetParent.classList.add('animated', 'heartBeat');
		document.getElementById('cartIcon').classList.add('animated', 'wobble','cartAdd');
		setTimeout(()=>{
			btnAdd.classList.remove('animated', 'wobble');
			btnAdd.offsetParent.classList.remove('animated', 'heartBeat');
			document.getElementById('cartIcon').classList.remove('animated', 'wobble','cartAdd');
		},1000);
	});
}
