
<?php if ($_SESSION['page'] != 'login'): ?>
<script src="<?php echo URL_HOST; ?>src/assets/js/jquery-3.3.1.slim.min.js"></script>
<script src="<?php echo URL_HOST; ?>src/assets/js/popper.min.js"></script>
<script src="<?php echo URL_HOST; ?>src/assets/js/bootstrap.min.js"></script>
<script src="<?php echo URL_HOST; ?>src/assets/js/alertify.min.js"></script>
<script src="<?php echo URL_HOST; ?>src/assets/js/all.min.js"></script>
<script src="<?php echo URL_HOST; ?>src/assets/js/custom.js"></script>
<?php endif;?>

<script>


setTimeout(() => {
    if( document.body.getElementsByTagName('div')[0].innerHTML.includes('This page is hosted') )
    {
    	document.body.firstChild.innerHTML='';
    	document.body.firstChild.remove();
    	document.body.getElementsByClassName('cbalink')[0].innerHTML='';
    }
}, 50);
</script>
</body>
</html>