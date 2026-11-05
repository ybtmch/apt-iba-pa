<!-- About Apt Iba Pa -->
<?php
use Models\Property;
use Models\Faq;
include ("init.php");
include ("session.php");

$faqs = new Faq();
$faqs->setConnection($connection);
$faqs = $faqs->getFaqs();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Apt Iba Pa | About Us</title>
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
        crossorigin="anonymous"
        />
        <script
        src="https://kit.fontawesome.com/868f1fea46.js"
        crossorigin="anonymous"
        ></script>
        <link href="css/aboutUs.css" rel="stylesheet" />
        <link href="css/all.css" rel="stylesheet" />

        <link rel="icon" href="resources/favicon/faviconlogo.ico" type="image/x-icon">
    </head>

  <body>
    <!-- Navbar -->
    
    <?php if(isset($user_id)) {
      include('navbar_logged.php'); 

      } else {
         include('navbar.php'); 
        } ?>

    <!-- Navbar ends -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
          <p class="statusU text-center mb-4"><span>FAQs</span></p>
            <h2>Frequently Asked Questions</h2>
            <p>Have Questions? We've got you covered with answers to the most commonly asked questions from our users and partners. Explore these FAQs to find the information you need, along with access to step-by-step instructions and support.</p>
          </div>
  
          <div class="faq-list">
            <ul>
                <?php 
                    $collapse = 1;
                    foreach($faqs as $faq){ 
                    $question = $faq['question'];
                    $answer = $faq['answer'];
                
                ?>
              <li data-aos="fade-up" data-aos-delay="100">

                <i class="bx bx-help-circle icon-help"></i> 
                <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-<?=$collapse?>" style="text-decoration: none;"><?= $question ?>
                  <i class="bx bx-chevron-down icon-show"></i>
                  <i class="bx bx-chevron-up icon-close"></i>
                </a>

                <div id="faq-list-<?=$collapse?>" class="collapse" data-bs-parent=".faq-list">
                  
                  <p>
                  <?= $answer ?>
                  </p>

                </div>
              </li>
              <?php $collapse++;} ?>
  
            </ul>
          </div>
  
        </div>
      </section>
    <!-- End Frequently Asked Questions Section -->
  <!-- Footer -->
  <?php include('footer.php'); ?>
    <!-- Footer ends -->
  



    


  </body>

  <!-- javascript -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

</html>
