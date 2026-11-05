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
        <title>Apt Iba Pa | Terms of Services</title>
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
        <link href="css/termsOfService.css" rel="stylesheet" />
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
    <section id="tos" class="tos section-bg">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
          <p class="statusU mb-4"><span>APT. IBA PA</span></p>
            <h2>Terms of Service</h2>
          </div>
  
          <div class="tos-list">
            <div class="row">
              <p class="tosDetails ms-0 ms-lg-3">
              Welcome to APT. IBA PA, the map-based directory and review system for dormitories and apartments near Angeles University Foundation (AUF), developed by APT Team ("we," "us," or "our"). By accessing the APT. IBA PA website and mobile application (collectively, the "Platform"), you agree to be bound by these Terms of Service ("Terms"). These Terms govern your access to and use of the Platform, as well as any related services and features (collectively, the "Services"). If you do not agree to these Terms, please do not use the Platform. Please read them carefully. If you have any questions about these Terms, please contact us.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">1. Acceptance of Terms</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                1.1 These Terms constitute a legally binding agreement between you and APT. IBA PA. By accessing the Platform, you accept and agree to be bound by these Terms.
              </p>
              <p class="tosDetails ms-0 ms-lg-3 mt-2">
                1.2 APT. IBA PA reserves the right to modify these Terms at any time. We will notify users of any changes to these Terms through the Platform. Your continued use of the Platform after the changes are posted constitutes your acceptance of the updated Terms.
              </p>
            </div>

            <div class="row mt-4">
              <h1 class="tosTitle">Our Services</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                1.3 Our service functions as a platform that facilitates the connection between property owners and individuals in search of accommodations within the vicinity of Angeles University Foundation, which are listed in APT. IBA PA.
              </p>
              <p class="tosDetails ms-0 ms-lg-3 mt-2">
                These properties operate as separate, third-party service providers in accordance with agreements made with APT. IBA PA. Unless specified otherwise through a seperate written agreement with APT. IBA PA, our Services are primarily intended for your personal, non-commercial use.
              </p>
              <p class="tosDetails ms-0 ms-lg-3 mt-2">
                YOU ACKNOWLEDGE THAT APT. IBA PA DOES NOT OFFER ACCOMMODATION OR LOGISTICS SERVICES NOR OPERATE AS A PROPERTY.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">2. Eligibility</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                You must be at least 18 years old to use the Platform. By using the Platform, you represent and warrant that you have the legal capacity to enter into this agreement.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">3. User Accounts</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                3.1 <strong>Registration:</strong> To access certain features of APT. IBA PA, you may be required to create an account. You agree to provide accurate and complete information during the registration process and to keep your account information updated. 
              </p>
              <p class="tosDetails ms-0 ms-lg-3 mt-2">
                3.2 <strong>Account Security:</strong> You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. If you suspect any unauthorized use of your account, please notify us immediately. You agree to notify APT. IBA PA immediately of any unauthorized use of your account.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">4. Features and Use of the Platform</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                4.1 <strong>For Tenants:</strong>APT. IBA PA provides a platform for users to search and discover available dormitories and apartments near Angeles University Foundation, view detailed property information, read and write reviews, schedule ocular visits to properties, reserve accommodations, and connect with property owners. As a user, you agree to use the Services responsibly and in compliance with all applicable laws and regulations. 
              </p>
              <p class="tosDetails ms-0 ms-lg-3 mt-2">
                4.2 <strong>For Landlords:</strong> APT. IBA PA offers property owners a platform to list their accommodations, manage inquiries, accept reservations, and interact with potential tenants. Property owners using the Services agree to accurately represent their properties and comply with relevant rental laws and regulations.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">5. Platform Content and Intellectual Property</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                5.1 User-Generated Content: APT. IBA PA may contain user-generated content, including property listings, reviews, and comments. You are solely responsible for the content you post on the Platform. You are prohibited from posting on the Website or within the Services, or transmitting to APT. IBA PA or any other Member, any content that is offensive, inaccurate, abusive, obscene, profane, sexually explicit, threatening, intimidating, harassing, racially offensive, or illegal. Additionally, you must not post content that infringes or violates another person's rights, including intellectual property rights, and rights of privacy and publicity. You confirm and warrant that all information you provide during registration is accurate and truthful, and you agree to promptly update any information that becomes inaccurate, misleading, or false. 
              </p>
              <p class="tosDetails ms-0 ms-lg-3 mt-2">
                5.2 You acknowledge and agree that Rentalbee has the option, but not the obligation, to monitor or review any content you post on the Website or as part of the Services. Rentalbee may remove any content, whether in whole or in part, if it is determined, in the sole discretion of Rentalbee, to violate this Agreement or potentially harm the reputation of the Website or Rentalbee.
              </p>
              <p class="tosDetails ms-0 ms-lg-3 mt-2">
                5.3 APT. IBA PA's Content: The Platform and its content, including text, graphics, images, and software, are the property of APT. IBA PA. You may not reproduce, distribute, or create derivative works from any content on the Platform without our express permission.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">6. Data Use and Privacy</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                APT. IBA PA respects your privacy. We collect and use personal information in accordance with our Privacy Policy, which is incorporated by reference into these Terms. By using the Platform, you consent to our collection and use of your personal information as described in the Privacy Policy.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">7. Communication</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                Email and Notifications: By using the Platform, you agree to receive communications from APT. IBA PA, including emails and notifications related to your account and the services provided by the Platform.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">8. Disclaimers</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                8.1 APT. IBA PA provides a platform for users to interact, but we do not endorse or guarantee the accuracy of property listings, reviews, or other content on the Platform. Users are encouraged to verify information and conduct their due diligence.
              </p>
              <p class="tosDetails ms-0 ms-lg-3 mt-2">
                8.2 APT. IBA PA is not responsible for any disputes, damages, or issues that may arise between users. Users are encouraged to resolve any disputes independently.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">9. Limitation of Liability</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                APT. IBA PA shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses resulting from your use of the Platform.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">10. Termination</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                APT. IBA PA reserves the right to terminate or suspend your account and access to the Platform at its discretion, with or without notice, for any reason. If your account is terminated, you may lose access to your account data and any ongoing reservations.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">11. Modification of Terms</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                APT. IBA PA reserves the right to make alterations or updates to these Terms without prior notification. The effective date of the updated Terms will be clearly specified at the beginning of the document. Your continued use of the Services following the publication of such changes signifies your agreement to the modified Terms.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">12. Governing Law and Jurisdiction</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                These Terms are regulated and construed under the laws of Angeles City, Pampanga, Philippines, without taking into account any conflicting legal principles. Any disputes arising from or related to these Terms will be exclusively subject to the jurisdiction of the courts situated in Angeles City, Pampanga, Philippines.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">13. Contact Information</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                For any questions or concerns regarding these Terms or the Services, you can contact us at:
              </p>
              <p class="tosDetails ms-0 ms-lg-3">
                <strong>hello.aptibapa@gmail.com</strong>
              </p>
            </div>

            <div class="row mt-5 pt-3 mb-5">
              <p class="tosDetails ms-0 ms-lg-3 mb-4">
                Thank you for using <strong>APT. IBA PA</strong>! We hope you have a great experience finding suitable accommodations near Angeles University Foundation or promoting your properties through our platform.
              </p>
              <p class="tosDetails ms-0 ms-lg-3">
                Effective Date: November 11, 2023<br>
                Last Updated: November 11, 2023
              </p>
            </div>

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
