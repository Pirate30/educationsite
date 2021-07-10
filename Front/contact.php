<!-- contact section -->
<section id="contact" class="contact">
    <h1 class="heading">Contact Us</h1>
    <h3>
        <?php
        //check whether the response is submitted and showing hthe appropreat mesg
        if (isset($_SESSION['contact-sent'])) {
            echo $_SESSION['contact-sent'];
            unset($_SESSION['contact-sent']);
        }
        //check whether the number user submitting in response is exist in db or not, and showing hthe appropreat mesg
        if (isset($_SESSION['contact-exist'])) {
            echo $_SESSION['contact-exist'];
            unset($_SESSION['contact-exist']);
        }
        ?>
    </h3>
    <div class="row">
        <form action="contact-submit.php" method="post">
            <input type="text" name="contact_name" placeholder="Full Eame" class="box" required>
            <!-- <input type="email" placeholder="Your Email" class="box" > -->
            <input type="number" name="contact_number" placeholder="Your Phone Number" class="box" required>
            <textarea name="contact_address" id="" cols="30" rows="10" class="box address" placeholder="Your Address"></textarea>
            <textarea name="contact_detail" id="" cols="30" rows="10" class="box address" placeholder="Your Reason To Contacting Us" required></textarea>
            <input type="submit" class="btn" name="submit">

        </form>
        <div class="image">
            <img src="images/contact-img.png" alt="">
        </div>
    </div>
</section>
<!--finished contact section -->