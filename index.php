<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>FunOlympic</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="css/index.css">

</head>
<body>
  <header class="header">
    <a href="index.php" class="logo">FunOlympic</a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
      <li><a href="login.php">Signin</a></li>
    </ul>
  </header>

<div class="slider" id="slider" style="--img-prev:url(images/badminton.jpg);"> 
  <div class="head">
    <h1>
        Experience the Thrill <br />
        Join the Fun!
    </h1>
    <p>Watch All Your Favourite FunOlympic Games Here!</p>
  </div>
  
  <div class="slider__content" id="slider-content">
    <div class="slider__images">
      <div class="slider__images-item slider__images-item--active" data-id="1"><img src="images/badminton.jpg"/></div>
      <div class="slider__images-item" data-id="2"><img src="images/football.jpg"/></div>
      <div class="slider__images-item" data-id="3"><img src="images/basketball.jpg"/></div>
      <div class="slider__images-item" data-id="4"><img src="images/boxing.jpg"/></div>
      <div class="slider__images-item" data-id="5"><img src="images/tabletennis.jpg"/></div>
      <div class="slider__images-item" data-id="6"><img src="images/karate.jpg"/></div>
      <div class="slider__images-item" data-id="7"><img src="images/volleyball.jpg"/></div>
      <div class="slider__images-item" data-id="8"><img src="images/skateboarding.jpg"/></div>
    </div>
    <div class="slider__text">
      <div class="slider__text-item slider__text-item--active" data-id="1">
        <div class="slider__text-item-head">
          <h3>Badminton</h3>
        </div>
        <div class="slider__text-item-info">
          <p>“Badminton is a fast-paced racket sport played between two players or pairs. Using lightweight rackets, players hit a shuttlecock over the net, aiming to score points by landing it in the opponent's court. It requires agility, precision, and strategy.”</p>
        </div>
      </div>
      <div class="slider__text-item" data-id="2">
        <div class="slider__text-item-head">
          <h3>Football</h3>
        </div>
        <div class="slider__text-item-info">
          <p>“Football is a team sport played between two teams of eleven players, aiming to score goals by kicking a ball into the opponent's net. It's a dynamic game combining skill, strategy, and teamwork, enjoyed by millions worldwide.”</p>
        </div>
      </div>
      <div class="slider__text-item" data-id="3">
        <div class="slider__text-item-head">
          <h3>Basketball</h3>
        </div>
        <div class="slider__text-item-info">
          <p>“Basketball is a fast-paced team sport played between two teams of five players each. The objective is to score points by shooting the ball through the opponent's hoop. Players move the ball by dribbling and passing. It emphasizes agility, coordination, shooting accuracy, and teamwork.”</p>
        </div>
      </div>
      <div class="slider__text-item" data-id="4">
        <div class="slider__text-item-head">
          <h3>Boxing</h3>
        </div>
        <div class="slider__text-item-info">
          <p>“Boxing is a combat sport where two opponents fight using only their fists within a ring. The goal is to score points by landing punches or knocking out the opponent. It requires strength, speed, and defensive skills.”</p>
        </div>
      </div>
      <div class="slider__text-item" data-id="5">
        <div class="slider__text-item-head">
          <h3>Table Tennis</h3>
        </div>
        <div class="slider__text-item-info">
          <p>“Table tennis, also known as ping pong, is a fast-paced indoor sport played on a table divided by a net. Players use paddles to hit a lightweight ball back and forth across the table, aiming to score points by making the ball unreturnable for their opponent. It requires quick reflexes, precision, and agility.”</p>
        </div>
      </div>
      <div class="slider__text-item" data-id="6">
        <div class="slider__text-item-head">
          <h3>Karate</h3>
        </div>
        <div class="slider__text-item-info">
          <p>Karate is a Japanese martial art that uses striking techniques with hands, feet, elbows, and knees, as well as blocking and grappling, to develop physical and mental discipline.</p>
        </div>
      </div>
      <div class="slider__text-item" data-id="7">
        <div class="slider__text-item-head">
          <h3>Volleyball</h3>
        </div>
        <div class="slider__text-item-info">
          <p>“Volleyball is a team sport played on a rectangular court with a net in the middle. Teams of six players aim to score points by hitting a ball over the net and onto the opponent's court, while preventing the opposing team from doing the same. It requires teamwork, communication, and agility.”</p>
        </div>
      </div>
      <div class="slider__text-item" data-id="8">
        <div class="slider__text-item-head">
          <h3>Skateboarding</h3>
        </div>
        <div class="slider__text-item-info">
          <p>“Skateboarding is a sport where individuals ride on a skateboard, performing tricks and maneuvers. It involves using feet to propel and control the board, navigating various terrains such as streets, parks, and ramps. The culture emphasizes individuality, self-expression, and community.”</p>
        </div>
      </div>
    </div>
  </div>

  <div class="slider__nav">
    <div class="slider__nav-arrows">
      <div class="slider__nav-arrow slider__nav-arrow--left" id="left">to left</div>
      <div class="slider__nav-arrow slider__nav-arrow--right" id="right">to right</div>
    </div>
    <div class="slider__nav-dots" id="slider-dots">
      <div class="slider__nav-dot slider__nav-dot--active" data-id="1"></div>
      <div class="slider__nav-dot" data-id="2"></div>
      <div class="slider__nav-dot" data-id="3"></div>
      <div class="slider__nav-dot" data-id="4"></div>
      <div class="slider__nav-dot" data-id="5"></div>
      <div class="slider__nav-dot" data-id="6"></div>
      <div class="slider__nav-dot" data-id="7"></div>
      <div class="slider__nav-dot" data-id="8"></div>
    </div>
  </div>
</div>
  <script  src="js/index.js"></script>
</body>
</html>
