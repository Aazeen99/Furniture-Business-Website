<?php
include "userNavigation.php";
include "db.php";

// Fetch all images and taglines from the database
function fetchSliderDataFromDatabase($conn) {
    $sliderData = array();

    $sql = "SELECT slider_image, slider_tagline FROM home_slider";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $sliderData[] = $row;
        }
    }

    return $sliderData;
}

// Fetch slider data from the database
$sliderData = fetchSliderDataFromDatabase($conn);

// Fetch "About Us" paragraph from the database
$sqlAboutUs = "SELECT about_us FROM customize_about_us WHERE about_us_id = '1'";
$resultAboutUs = $conn->query($sqlAboutUs);
$aboutUsParagraph = $resultAboutUs->fetch_assoc()['about_us'];

// Fetch testimonials from the database
$sqlTestimonials = "SELECT user_name, testimonial FROM testimonials";
$resultTestimonials = $conn->query($sqlTestimonials);

//featured products display
$sql = "SELECT * FROM featured_products LIMIT 6";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Furniture Website</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <!-- Content here -->
    <div class="slider-container">
        <div class="slider-images">
            <?php foreach ($sliderData as $index => $slide): ?>
                <div class="slide-container <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo $slide['slider_image']; ?>" class="slide">
                    <div class="tagline-container">
                        <?php echo $slide['slider_tagline']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <!--About Us section-->
    <div class="external-about-us">
        <div class="about-us-section">
            <h2>About Us</h2>
            <?php 
            // Split the about us paragraph into separate paragraphs based on line breaks
            $paragraphs = explode("\n", $aboutUsParagraph);
            foreach ($paragraphs as $paragraph) {
                echo "<p>$paragraph</p>";
            }
            ?>
        </div>
    </div>

    
    <div class="external container">
        <h2 class="fpheading">Featured Products</h2>
        <div class="container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="card" onclick="location.href='product_detail.php?prod_id=<?php echo $row['prod_id']; ?>'">
                        <img src="thumbnailFolder/<?php echo $row['thumbnail_image']; ?>" alt="Product Thumbnail">
                        <div class="name-price-container">
                            <h4><?php echo $row['prod_name']; ?></h4>
                            <p class="price">$<?php echo $row['prod_price']; ?></p>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </div>
        

    <div class="testimonial-section">
        <h2>Testimonials</h2>
        <div class="testimonial-slider">
            <div class="testimonial-cards">
                <?php
                if ($resultTestimonials->num_rows > 0) {
                    while ($row = $resultTestimonials->fetch_assoc()) {
                        // Dynamically create testimonial card for each testimonial
                        echo '<div class="testimonial-card">';
                        echo '<p>' . $row['testimonial'] . '</p>';
                        echo '<span class="bold-text">' . $row['user_name'] . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo "No testimonials available.";
                }
                ?>
            </div>
        </div>
    </div>


    <script>
        function slideImages() {
            const slides = document.querySelectorAll('.slide-container');
            const slideCount = slides.length;
            const slideTime = 3000; // Time for each slide
            let currentIndex = 0;

            setInterval(() => {
                // Hide current slide
                slides[currentIndex].classList.remove('active');

                // Move to next slide
                currentIndex = (currentIndex + 1) % slideCount;

                // Show next slide
                slides[currentIndex].classList.add('active');
            }, slideTime);
        }

        // Entry point
        document.addEventListener('DOMContentLoaded', slideImages);

        function scrollTestimonials() {
            const testimonialCards = document.querySelector('.testimonial-cards');
            const scrollSpeed = 4; // Adjust the scrolling speed

            setInterval(() => {
                // Calculate the new scroll position
                const newScrollLeft = testimonialCards.scrollLeft + scrollSpeed;

                // Scroll to the new position
                testimonialCards.scrollLeft = newScrollLeft;

                // If reached the end, reset to the beginning
                if (testimonialCards.scrollLeft >= testimonialCards.scrollWidth - testimonialCards.clientWidth) {
                    testimonialCards.scrollLeft = 0;
                }
            }, 50); // Adjust the interval for smooth scrolling
        }

        // Entry point
        document.addEventListener('DOMContentLoaded', () => {
            scrollTestimonials();
        });
    </script>

    <?php
        include "userFooter.php";
    ?>
</body>
</html>
