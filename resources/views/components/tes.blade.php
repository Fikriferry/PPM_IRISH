<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us - Irish Bakehouse</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #2b1b18;
      color: white;
      font-family: 'Segoe UI', sans-serif;
    }
    .navbar {
      background-color: #e0dcd9;
    }
    .navbar a {
      color: black !important;
    }
    .hero-section {
      padding: 80px 0 40px;
      text-align: center;
    }
    .hero-section h1 {
      font-size: 3rem;
      font-weight: bold;
    }
    .breadcrumb {
      background: none;
      justify-content: center;
      margin-top: 10px;
    }
    .story-section {
      background-color: #753f36;
      padding: 60px 20px;
    }
    .story-title {
      color: #f8a42f;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .story-image {
      background-image: url('{{ asset('static/image/about-placeholder.jpg') }}');
      background-size: cover;
      background-position: center;
      width: 100%;
      height: 200px;
    }
    .box-white {
      background-color: white;
      color: black;
      padding: 15px;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">IRISH BAKEHOUSE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/menu">Menu</a></li>
        <li class="nav-item"><a class="nav-link active" href="/about">About</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="hero-section">
  <h1><span style="color: #f8a42f;">ABOUT</span> US</h1>
  <nav class="breadcrumb">
    <a class="breadcrumb-item text-light text-decoration-none" href="/">Home</a>
    <span class="breadcrumb-item active text-light">About Us</span>
  </nav>
</div>

<!-- Our Story Section -->
<div class="story-section text-white">
  <div class="container">
    <h2 class="story-title">OUR STORY</h2>
    <div class="row gy-4">
      <div class="col-md-6">
        <p>Coffee shop yang nyaman dan kekinian di Tegal, menghadirkan beragam dessert lezat, hidangan nasi hangat, dan kopi berkualitas untuk menemani waktu santaimu. Kami buka setiap hari mulai sore hingga tengah malam, siap jadi tempat andalanmu untuk bersantai maupun merayakan momen spesial.</p>
        <p>We know, and so do you, that the world's best coffee beans come from Indonesia. We travel to various corners of Indonesia and work with local coffee farmers and roasters to get the best taste of Indonesian coffee, grade one Arabica beans and various plantations spread across the archipelago.</p>
        <p>With our experience and knowledge in the retail coffee industry, from coffee bean processing to how to design a coffee bar, we make your coffee business journey EASY, SIMPLE, and FUN!</p>
      </div>
      <div class="col-md-6">
        <div class="story-image mb-4"></div>
        <div class="row">
          <div class="col-8">
            <div class="story-image"></div>
          </div>
          <div class="col-4">
            <div class="box-white">
              <strong>OPENING HOURS</strong><br/>
              16:00 – 00:00 | Open Daily
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
