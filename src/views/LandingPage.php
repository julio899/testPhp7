  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo URL_HOST; ?>">testPhp7 - By Julio Vinachi </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

          <?php if (isset($_SESSION['acc'])): ?>
            <li class="nav-item iten-user">
              Wellcome, <strong><?php echo $_SESSION['acc']; ?></strong>
              <a href="#" class="badge badge-light bg-balance">$<?php echo $_SESSION['acc_balance']; ?></a>
              <a href="#" class="simb">&#128181;</a>

            </li>
          <?php endif;?>
          <li class="nav-item">
            <div class="btn-group">

              <a href="#Cart" id="touch-cart-list" class="cart cart-icon dropdown-toggle" data-toggle="dropdown" ><i id="cartIcon" class="fas fa-shopping-cart"></i></a>
              <div class="dropdown-menu" id="container-cart-list">
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" id="pickupContainer" href="#">
                  <i id="pickup" class="fas fa-truck-pickup pickup" data-toggle="tooltip" data-placement="top" title="pick up"></i>
                  <i id="ups" class="fas fa-truck pickup" data-toggle="tooltip" data-placement="top" title="UPS"></i>
                  <span id="baged-truck" class="badge badge-secondary badge-pill baged-pick-up">$0.00</span>
                </a>

                <a class="dropdown-item" href="#">Total & Detaills <span id="baged-total" class="badge badge-warning badge-pill baged-total">$0.00</span></a>

                <span id="btn-pay" class="dropdown-item badge badge-success form-control btn-pay">Buy</span>
              </div>

            </div>
          </li>

          <li class="nav-item">
            <?php if (!isset($_SESSION['acc'])): ?>
              <a class="nav-link btn btn-primary" href="login">Login</a>
            <?php else: ?>
              <a class="nav-link btn btn-danger" href="logout">Logout</a>
            <?php endif;?>

          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">Welcome!</h1>
      <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
      <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
    </header>

    <!-- Page Features -->
    <div class="row text-center">
      <?php if (isset($parameters) && isset($parameters['products'])): ?>
        <?php foreach ($parameters['products'] as $key => $product): ?>

          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
              <img class="card-img-top" src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
              <div class="card-body">
                <h4 class="card-title"><?php echo $product['name']; ?></h4>
                <p class="card-text"><?php echo $product['description']; ?></p>
              </div>
              <div class="card-footer">

                <?php if (isset($_SESSION['acc'])): ?>
                    <span class="form-control">

                      <?php for ($countStar = 1; $countStar < 6; $countStar++): ?>
                        <?php if ($countStar <= $product['starDinamic']): ?>
                          <i class="fas fa-star star-yellow"></i>
                        <?php else: ?>
                          <i class="far fa-star"></i>
                        <?php endif;?>
                      <?php endfor;?>

                      <i onclick="getCommentaries(<?php echo $product['id']; ?>)" class="fa fa-users pull-right hand" data-placement="top" title="all commentaries" data-toggle="modal" data-target="#allCommentaries"></i>
                      <?php if (count($product['starByUser']) > 0): ?>

                        <i
                            onclick="modCalcification(this)"
                            class="fa fa-file-signature pull-right hand"
                            data-toggle="modal"
                            data-target="#calcificationStar"
                            title="edit or change calcification"
                            data-commentary="<?php echo $product['starByUser'][0]['commentary']; ?>";
                            data-stars="<?php echo $product['starByUser'][0]['stars']; ?>";
                            data-product-id="<?php echo $product['id']; ?>";
                            ></i>
                      <?php else: ?>
                        <i class="far fa-hand-point-left pull-right hand" data-toggle="tooltip" data-placement="top" title="Qualify"></i>
                      <?php endif;?>

                    </span>
                <?php endif;?>
                <span class="badge badge-success badge-price form-control">$<?php echo $product['price']; ?></span>
                <a href="#" class="btn btn-primary form-control btn-add" data-price="<?php echo $product['price']; ?>" data-name="<?php echo $product['name']; ?>" data-id="<?php echo $product['id']; ?>">add to cart</a>
              </div>
            </div>
          </div>

        <?php endforeach;?>
      <?php endif;?>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">By Julio Vinachi 2019</p>
    </div>
    <!-- /.container -->
  </footer>


<!-- Modals -->

<!-- Calificate Star -->
<div class="modal fade" id="calcificationStar" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Calcification of Star</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body content-commentaries">
         <div class="loader2"></div>

          <div class="star-container">
              <i id="star1" onclick="activateStar(this)" class="far fa-star star-plus"></i>
              <i id="star2" onclick="activateStar(this)" class="far fa-star star-plus"></i>
              <i id="star3" onclick="activateStar(this)" class="far fa-star star-plus"></i>
              <i id="star4" onclick="activateStar(this)" class="far fa-star star-plus"></i>
              <i id="star5" onclick="activateStar(this)" class="far fa-star star-plus"></i>
          </div>


         <input id="comment-edit" class="form-control form-control-lg" type="text" placeholder="Some Comment">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mb-2" data-dismiss="modal">Close</button>
        <button type="button" onclick="updateStar()" class="btn btn-primary mb-2">Confirm Change</button>
      </div>
    </div>
  </div>
</div>
<!-- ./ Calificate Star -->

<!-- All Commentaries -->
<div class="modal fade" id="allCommentaries" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">All Commentaries</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body content-commentaries">
         <div class="loader2"></div>
         <ul id="list-commentaries" class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Cras justo odio
            <span class="badge badge-primary badge-pill">14</span>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>