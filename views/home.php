<?php
include "../templates/header.php";
?>
      <!-- BANNER -->
      <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-auto">
                    <h3>Sweet Beauty</h3>
                    <span>Maquillaje & peinados</span>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum sapiente hic provident quae minima fuga libero ut et aliquid reprehenderit. Ex adipisci fuga architecto minus nemo repellendus soluta amet molestiae.</p>
                    <a href="#" class="boton btn-sm">Agendar cita</a>
                </div>
            </div>
        </div>
      </section>
      <!-- FIN DE BANNER -->

      <!-- PORTAFOLIO -->
      <section class="portafolio section-padding">
        <h1 class="heading m-5"><span> Mi </span> portafolio </h1>
        <div class="container">
            <div class="row">
                <!-- CAROUSEL -->
                <div id="carouselExampleAutoplaying" class="carousel slide col-lg-6" data-bs-ride="carousel">
                    <div class="carousel-inner imagenes">
                      <div class="carousel-item active">
                        <img src="../img/home/ej10.jpg" class="d-block img-fluid" alt="...">
                        <h3>Ejemplos</h3>
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/ej3.jpg" class="d-block img-fluid" alt="...">
                        <h3>Ejemplos</h3>
                      </div>
                      <div class="carousel-item">
                        <img src="../img/home/ej2.jpg" class="d-block img-fluid" alt="...">
                        <h3>Ejemplos</h3>
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                <!-- FIN DEL CAROUSEL -->
                <div class="content col-lg-6">
                    <h3>Algunos de mis trabajos</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, maxime! Voluptate voluptatem sequi dolor modi nulla, quia accusantium iure est quo nemo dignissimos laudantium aspernatur repudiandae rerum minus ea atque.</p>
                    <a href="#" class="boton link">Ver más</a>
                </div>
               </div>
            </div>
        </div>
      </section>
      <!-- FIN DE PORTAFOLIO -->

      <!-- PRODUCTOS -->
    <section class="products section-padding">
        <h1 class="heading m-5"><span>Últimos </span>Productos</h1>
        <div class="container">
          <div class="owl-carousel owl-theme">
            <!-- CARDS DE LOS PRODUCTOS -->

            <div class="item">
              <div class="card">
                <span class="aviso">-10%</span>
                  <a href="../views/verproducto.php"><img src="../img/home/m1.jpg" class="card-img-top" alt="..."></a> 
                  <div class="card-body text-center">
                    <div class="icons card-title">
                      <a href="#" class="bi bi-suit-heart-fill"></a>
                      <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
                      <a href="#" class="bi bi-share"></a>
                    </div>
                    <div class="card-text">
                      <a href="../views/verproducto.php">Paleta de Sombras Cooky BT21</a>
                      <div class="price">
                          $369.00 <span>$410.00</span>
                    </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- END ITEM -->

          <div class="item">
            <div class="card">
                <img src="../img/home/es1.jpg" class="card-img-top" alt="...">
                <div class="card-body text-center">
                  <div class="icons card-title">
                    <a href="#" class="bi bi-suit-heart-fill"></a>
                    <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
                    <a href="#" class="bi bi-share"></a>
                  </div>
                  <div class="card-text">
                    <h3>Esmalte H&M rosa</h3>
                    <div class="price">
                      $45.00
                  </div>
                  </div>
                </div>
          </div>
        </div>
        <!-- END ITEM -->

        <div class="item">
          <div class="card">
              <img src="../img/home/es2.jpg" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <div class="icons card-title">
                  <a href="#" class="bi bi-suit-heart-fill"></a>
                  <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
                  <a href="#" class="bi bi-share"></a>
                </div>
                <div class="card-text">
                  <h3>Esmalte H&M Morado</h3>
                  <div class="price">
                    $45.00
                </div>
                </div>
              </div>
        </div>
      </div>
      <!-- END ITEM -->

      <div class="item">
        <div class="card">
            <img src="../img/home/es3.jpg" class="card-img-top" alt="...">
            <div class="card-body text-center">
              <div class="icons card-title">
                <a href="#" class="bi bi-suit-heart-fill"></a>
                <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
                <a href="#" class="bi bi-share"></a>
              </div>
              <div class="card-text">
                <h3>Esmalte H&M naranja</h3>
                <div class="price">
                  $45.00
              </div>
              </div>
            </div>
      </div>
    </div>
    <!-- END ITEM -->

    <div class="item">
      <div class="card">
        <span class="aviso">-10%</span>
          <img src="../img/home/es4.jpg" class="card-img-top" alt="...">
          <div class="card-body text-center">
            <div class="icons card-title">
              <a href="#" class="bi bi-suit-heart-fill"></a>
              <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
              <a href="#" class="bi bi-share"></a>
            </div>
            <div class="card-text">
              <h3>Esmalte H&M rosa palido</h3>
              <div class="price">
                $40.50 <span>$45.00</span>
            </div>
            </div>
          </div>
    </div>
  </div>
  <!-- END ITEM -->

  <div class="item">
    <div class="card">
        <img src="../img/home/es5.jpg" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <div class="icons card-title">
            <a href="#" class="bi bi-suit-heart-fill"></a>
            <a href="#" class="bi bi-bag-heart-fill"> Agregar al carrito</a>
            <a href="#" class="bi bi-share"></a>
          </div>
          <div class="card-text">
            <h3>Esmalte H&M dorado</h3>
            <div class="price">
              $45.00
          </div>
          </div>
        </div>
  </div>
</div>
          <!-- END ITEM -->
      <!-- FIN CARDS DE LOS PRODUCTOS -->
        </div>
        </section>
      <!-- FIN DE PRODUCTOS -->

      <!-- CONTACTANOS -->
      <!-- FIN DE CONTACTANOS -->
<?php
include "../templates/footer.php"
?>