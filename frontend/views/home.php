<?php
require_once __DIR__ . "/../Template.php";

Template::header("Home");
?>
<?php if ($this->user->role !== "PT") { ?>

<h1>Your Fitness Journey Starts Here</h1>

<p>
Welcome to our Fitness Tracker App! Take control of your health and unleash your full potential with our comprehensive platform designed to elevate your fitness journey. Whether you're a seasoned athlete or just starting out, our app is here to support you every step of the way.
</p>

<p>
Track your activities effortlessly, from gym workouts to outdoor runs and everything in between. Set personalized goals and watch your progress unfold. From the moment you started, our app will keep a record of your initial status, providing you with a clear visualization of how far you've come. Update your activities whenever you make progress, whether it's increasing the number of reps, improving your speed, or surpassing personal milestones. Celebrate each achievement and witness your growth firsthand.
</p>
<h2> Expert Monitoring </h2>

<p>
Connect with your personal trainer through our app, enabling them to monitor and track your progress. Receive valuable feedback, customized guidance, and tailored workout plans to optimize your performance.
</p>
<h2> Customize it Yourself </h2>
<p class="last-p">
Looking for new activities to spice up your routine? Explore possible exercises based on your preferred muscle group! Discover exciting ways to stay motivated and keep pushing yourself to new heights. Embrace a healthier lifestyle, push your limits, and achieve your fitness aspirations with our Lorem Fitness Tracker App. Start your transformative journey today and unlock the best version of yourself.
</p>
<?php } 
else { ?>
<h1>Trainers, Let's Go</h1>
<p>
Welcome to the PT Portal! As a personal trainer, your expertise and dedication make a lasting impact on your clients' fitness journeys. Our comprehensive platform is designed to empower you and streamline your coaching process.
</p>
<p class="last-p">
Effortlessly manage and view all your clients in one place. Gain valuable insights into their progress, goals, and achievements, allowing you to provide personalized guidance and support. Track each client's activities, from workouts to tracking from beginning to present. Stay informed about their current status and witness the incredible transformations they undergo under your guidance.
</p>
<?php } ?>

<?php Template::footer(); ?>