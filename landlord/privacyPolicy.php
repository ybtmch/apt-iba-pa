<!-- About Apt Iba Pa -->
<?php
use Models\Property;
use Models\Faq;
include ("../init.php");
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
        <title>Apt Iba Pa | Privacy Policy</title>
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
      include('navbar.php'); 

      } else {
         include('navbar.php'); 
        } ?>

    <!-- Navbar ends -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="tos" class="tos section-bg">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
          <p class="statusU mb-4"><span>APT. IBA PA</span></p>
            <h2>Privacy Policy</h2>
          </div>
  
          <div class="tos-list">
            <div class="row">
              <p class="tosDetails ms-0 ms-lg-3 mb-4">
                APT. IBA PA is developed to create connections and foster inclusivity, aiming to make the process of finding dormitories and apartments near Angeles University Foundation more accessible and convenient. We prioritize trust within our community, and a crucial aspect of gaining that trust is ensuring transparency in how we handle your information and committed to protecting your privacy.
              </p>

              <p class="tosDetails ms-0 ms-lg-3 mb-2">
                By using the Services, you are giving your consent to follow the rules in this Privacy Policy. If you don't agree with any part of it, please refrain from using the Services.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">1.	Information We Collect</h1>
              <p class="tosSubDetails ms-0 ms-lg-3">
                1.1	We collect various types of information, including:
              </p>
              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">•	Personal Information:</span> </span> Name, email address, phone number, and other identifiable information you provide voluntarily.
              </p>

              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">• Payment Information:</span> Details necessary for processing payments (reservation fee), such as your financial information.
              </p>

              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">•	Property Information:</span> For landlords the details necessary in a property details, Address, amenities, rules and etc.
              </p>

              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">•	Images:</span> Property images that provides information for the landlord’s properties.
              </p>

            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">2.	How We Use Your Information</h1>
              <p class="tosSubDetails ms-0 ms-lg-3">
                2.1 We use your information for the following purposes:
              </p>
              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">• Providing Services:</span> </span> To offer and maintain our services, process reservations, and enhance user experience.
              </p>

              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">• Communication:</span> To communicate with you about our services and updates.
              </p>

              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">• Security:</span> To protect our platform and users from fraud, unauthorized access, and other security issues.
              </p>

              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">• Improvement:</span> To analyze and improve our services, including website functionality and user experience.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">3.	Information Sharing</h1>
              <p class="tosSubDetails ms-0 ms-lg-3">
                3.1 We may share your information with:
              </p>
              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">• Legal Compliance:</span> </span> When required by law or in response to legal requests.
              </p>

              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">• Business Transfers:</span> As a startup project we may entertain the possible acquisition of this website.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">4.	Your Choices</h1>
              <p class="tosSubDetails ms-0 ms-lg-3">
                4.1 You have the following choices regarding your information:
              </p>
              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">• Access and Correction:</span> You can access and correct your personal information through your account settings.
              </p>

              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">• Property Information:</span> You can manage your property information through your landlord account.
              </p>

              <p class="tosDetails ms-0 ms-lg-5 mt-2">
              <span class="subPPdetails">• Data Erasures:</span> Users can request their data to be deleted. Some data may be retained for future purposes, for example if account has a history of fraud which violates our rules.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">7.	Review Transparency and Accountability</h1>
              <p class="tosSubDetails ms-0 ms-lg-3">
                At APT. IBA PA, we believe in maintaining transparency and accountability in our review system to ensure the integrity of the feedback provided by our users. To achieve this, the following guidelines apply:
              </p>
              <p class="tosSubDetails ms-0 ms-lg-3 mt-2">
              7.1 One Review per Property: Users are allowed to submit only one review per property. This limitation is designed to promote genuine and thoughtful feedback from each user.
              </p>

              <p class="tosSubDetails ms-0 ms-lg-3 mt-2">
              7.2 Review Submission after Reservation: Users will be eligible to leave a review only after they have successfully reserved a unit or property from the respective dormitory or apartment. This ensures that reviews are based on actual experiences and interactions with the property.
              </p>

              <p class="tosSubDetails ms-0 ms-lg-3 mt-2">
              7.3 Appropriate and Respectful Reviews: We encourage users to provide reviews that are constructive, appropriate, and free from malicious or offensive language. Our community thrives on mutual respect, and reviews should reflect this ethos.
              </p>

              <p class="tosSubDetails ms-0 ms-lg-3 mt-2">
              7.4 Review Moderation by Admin/Apt. Iba Pa: To maintain the integrity of the review system, our team moderates reviews. This includes monitoring for compliance with our review guidelines, ensuring appropriateness, and addressing any potential violations. We reserve the right to edit or remove reviews that do not adhere to our community standards.
              </p>

              <p class="tosSubDetails ms-0 ms-lg-3 mt-2">
              7.5 Continuous Improvement: We are committed to continuously improving our review system based on user feedback and evolving community needs. Regular assessments and updates may be implemented to enhance the overall transparency and accountability of the review process.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">6. Security</h1>
              <p class="tosDetails ms-0 ms-lg-5 mt-2">
                We can’t guarantee perfect security, we are updating and continuously implement security measures to protect your information.
              </p>
            </div>

            <div class="row mt-5">
              <h1 class="tosTitle">7. Updates to This Policy</h1>
              <p class="tosDetails ms-0 ms-lg-5 mt-2">
                These policies are not permanent and may be subject to change.
              </p>
            </div>

            <div class="row mt-5 pt-5">
              <h1 class="tosTitle">Contact Us</h1>
              <p class="tosDetails ms-0 ms-lg-3">
                If you have any questions or concerns about our Privacy Policy, please contact us at 
              </p>
              <p class="tosDetails ms-0 ms-lg-3 mb-3">
                <strong>hello.aptibapa@gmail.com</strong>
              </p>
            </div>

            <div class="row mt-3 mb-5">
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
