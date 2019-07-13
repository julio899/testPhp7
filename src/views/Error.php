
<div class="alert alert-dark" role="alert">
  In <a href="#" class="alert-link">Development</a>.
</div>

<h1>Error View</h1>
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Error Detail!</h4>
  <hr>
<?php
if (isset($parameters) && isset($parameters['error'])) {
    echo '<p class="mb-0">' . $parameters['error'] . '</p>';
}
?>
</div>