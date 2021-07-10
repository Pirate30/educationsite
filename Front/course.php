 <!-- course section -->

 <section id="course" class="course">
     <h1 class="heading">Our Popular Courses</h1>
     <div class="box-container">
         <?php

            //  getting course data from the database
            $sql = "select * from `course`";
            $res = mysqli_query($con, $sql);
            if ($res == true) {
                // counting the row
                $count = mysqli_num_rows($res);;
                // checking if the data exists
                if ($count > 1) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $course_name = $row['course_name'];
                        $course_description = $row['course_description'];
                        $daily_hours = $row['daily_hours'];
                        $course_duration = $row['course_duration'];
                        $course_teacher_id = $row['course_teacher_id'];
                        $image_name = $row['image_name'];
            ?>
                     <div class="box">
                         <img src="<?php echo SITEURL; ?>admin/images/course/<?php echo $image_name; ?>" alt="">
                         <h3 class="price">$50</h3>
                         <div class="content">
                             <div class="rating">
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star"></i>
                                 <i class="fas fa-star-half"></i>
                             </div>
                             <a href="" class="title">Learn <?php echo $course_name; ?></a>
                             <p><?php echo $course_description; ?></p>
                             <div class="info">
                                 <h3><i class="far fa-clock"></i><?php echo $daily_hours; ?>&nbsp; Hours</h3>
                                 <h3><i class="far fa-calendar-alt"></i><?php echo $course_duration; ?>&nbsp; Months</h3>
                             </div>
                         </div>
                     </div>
         <?php
                    }
                }
            }

            ?>


     </div>
 </section>
 <!-- finished course section -->