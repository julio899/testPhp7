<div id="loader" class="lds-roller no-display"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

<?php if (isset($_SESSION['acc'])): ?>
  <input type="hidden" value="true" name="isLog" id="isLog">
<?php endif;?>

<input type="hidden" value="<?php echo URL_HOST; ?>" name="baseURI" id="baseURI">

<script>
if
    (
        document.getElementsByTagName('div')[0] !== null &&
        document.getElementsByTagName('div')[0].getAttribute('style') !== null &&
        document.getElementsByTagName('div')[0].getAttribute('style').includes('background')
    ){

        if (document.getElementsByTagName('div')[0].getAttribute('id')==null) {

            document.getElementsByTagName('div')[0].setAttribute('style','display:none');
        }

}
</script>
<?php if (isset($_SESSION['page']) && $_SESSION['page'] != 'login'): ?>
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