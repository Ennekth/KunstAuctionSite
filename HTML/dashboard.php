<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Auction Dashboard</title>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #f4f4f8;
    width: 100%;
    overflow-x: hidden;
  }

  header {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    background: linear-gradient(90deg, magenta, cyan);
    color: white;
    padding: 12px 10px;
    width: 100%;
  }
  .logo{
    height: 50px;
    width: 60px;
  }
  .logo img{
    height: 100%;
    width: 100%;
  }
  header .searchbar {
    flex: 1;
    margin: 0 20px;
    max-width: 200px;
  }

  header input {
    width: 100%;
    padding: 8px 12px;
    border: none;
    border-radius: 20px;
    outline: none;
  }
  .right ul{
    display: flex;
    
    list-style: none;
    height: 30px;
    align-items: center;
    width: auto;
    /* background-color: aqua; */
    
  }
  .right ul li{
    margin-left: 15px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 10px;
    height: 40px;
    width: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 5px;
    
  }
  .right ul li:hover{
    background-color: rgba(255, 255, 255, 0.63);
  }
  .right ul li a{
    text-decoration: none;
    color: white;
    font-size: larger;
  }
  .alterright{
    height: 50px;
    width: 50px;
    display: none;
    
    
}
.alterright #sidenav{
    display: none;
}
.alterright img{
    height: 80%;
    width: 80%;
    
}
#check:checked ~ .sidenav{
    display: block;
}

.sidenav{
    height: 100vh;
    width: 320px;
    position: fixed;
    z-index: 9;
    top: 0;
    right: 0;
    background-color: #000000d8;
    transition: 0.5s;
    padding-top: 10px;
    display: none;
    flex-direction: column;
    align-items: flex-start;
    

  }
  .sidenav ul{
    background-color: rgba(0, 131, 131, 0.411);
    backdrop-filter: blur(10px);
    box-shadow: 3px 3px 3px  rgb(0, 0, 0, 0.1);
    height: 100%;
    width: 100%;
    padding: 0;
    margin: 0;
    text-align: start;
  }
  .sidenav li{
    list-style: none;
    width: 100%;
    justify-content: center;
    align-items: center;
    display: flex;
    padding: 10px 0px 10px 0px;
    /* background-color: #ff00b3; */
  }
  .sidenav li:hover{
    background-color: rgb(0, 139, 139);
  }
  .sidenav a{
    text-decoration: none;
    font-size: larger;
    width: 100%;
    
    color: white;
    padding-left: 10px;
}
  .sidenav label{
    padding-left: 10px;
  }
  .sidenav label:hover{
    cursor: pointer;
    
    
  }
  .notification, .username {
    margin-left: 15px;
    font-weight: bold;
    cursor: pointer;
  }

  main {
    max-width: 1000px;
    margin: 30px auto;
    padding: 0 20px;
  }

  h2 {
    margin-top: 30px;
    color: #333;
  }

  .featured-items {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
  }
    .more-items {
    display: none;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
  }
  main label h2{
    text-decoration: underline;
    cursor: pointer;
  }
  #expand{
    display: none;
  }
  #expand:checked ~ .more-items{
    display: grid;
  }

  .item {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    text-align: center;
  }

  .item h3 {
    margin: 10px 0 5px;
  }
  .picbox{
    height: 100px;
    width: 100px;
    margin: auto;
  }
  .picbox img{
    height: 100%;
    width: 100%;
  }
  .item .time {
    color: #777;
    font-size: 14px;
    margin-bottom: 10px;
  }

  .item button {
    background: linear-gradient(90deg, magenta, cyan);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.2s;
  }

  .item button:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
  }

  .account-info {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    margin-top: 30px;
  }

  .recent-wins {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .recent-wins li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
  }

  .foot{
    
    width: 100%;
    background-color: rgb(88, 88, 88);
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 10px 0px 10px 0px;
}
.foot .topfoot{
    width: 100%;
    height: auto;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    /* background-color: #02d5fa; */
    flex-wrap: wrap;

}
.foot .topfoot .logo{
    width: 80px;
    height: 80px;
    /* background-color: #ff00b3; */
}
.foot .topfoot .logo img{
    width: 100%;
    height: 100%;
}
.foot .topfoot .contacts{
    width: auto;
    height: auto;
    /* background-color: #ff00b3; */
}
.foot .topfoot .socials{
    width: auto;
    max-width: 550px;
    height: auto;
    /* background-color: #ff00b3; */
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    flex-wrap: wrap;
    gap: 10px;
    margin: 10px;
}
.socials .s1{
    width: 50px;
    height: 50px;
    
}
.socials .s1 img{
    width: 100%;
    height: 100%;
}
.foot .bottomfoot{
    width: 100%;
    height: auto;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    /* background-color: #ff00b3; */
    flex-wrap: wrap;
    margin-top: 20px;
    margin-bottom: 30px;
}
.bottomfoot a{
    text-decoration: none;
    color: white;
}

  @media screen and (max-width: 600px) {
    .right{
        display: none;
    }
    .alterright{
        display: block;
        color: white;
        position: absolute;
        top: 65px;
        right: 5px;

    }
    header {
      flex-direction: column;
      align-items: flex-start;
    }
    header .searchbar {
      width: 100%;
      margin: 10px 0;
    }
}

</style>
</head>
<body>

<header>
  <div style="display: flex; justify-content: space-evenly; width: 100%; align-items: center;">
    <div class="logo"><img src="../ASSETS/Photos/LogoKunst.png" alt=""></div>
  <div class="searchbar"><input type="text" placeholder="Search items..."></div>
  </div>
          <div class="right">
            <ul>
                <li><a href="./index.html"><h5>Home</h5></a></li>
                <li style="background-color: teal;"><a href="./dashboard.php"><h5>Dashboard</h5></a></li>
                <li><a href="./account.html"><h5>Account</h5></a></li>
                <li><a href="./recharge.html"><h5>Recharge</h5></a></li>
                <li><a href="./help.html"><h5>Help</h5></a></li>
            </ul>
        </div>
        <div class="alterright">
            <input type="checkbox" name="check" id="check" style="position: absolute; opacity: 0;">
            <label for="check"><img src="../ASSETS/Photos/hamburger.svg" alt=""></label>
                        <div class="sidenav">
                            
                            <label  for="check"  ><img src="../ASSETS/Photos/minus.svg" alt="" style="width: 50px; height: 36px; margin-right: -220px; margin-top: 0px; background-color: rgba(0, 0, 0, 0.849); border-radius:10px; "></label>
                            <ul>
                                <li><label for="home"><img src="../ASSETS/Photos/home.svg" alt=""></label><a href="./index.html" id="home">Home</a></li>
                                <li><label for="dashboard"><img src="../ASSETS/Photos/dashboard.svg" alt=""></label><a href="./dashboard.php" id="dashboard">Dashboard</a></li>
                                <li><label for="account"><img src="../ASSETS/Photos/account.svg" alt=""></label><a href="./account.html" id="account">Account</a></li>
                                <li><label for="recharge"><img src="../ASSETS/Photos/recharge.svg" alt=""></label><a href="./recharge.html" id="recharge">Recharge</a></li>
                                <li><label for="help"><img src="../ASSETS/Photos/help.svg" alt=""></label><a href="./help.html" id="help">Help</a></li>
                            </ul>
                        </div>
        </div>
  <div class="notification">🔔</div>
  <div class="username">Hi, <?php echo $_SESSION['firstname']; ?></div>

</header>

<main>
  <h2>Featured Items</h2>
  <div class="featured-items">
    <div class="item">
      <h3>Vintage Watch</h3>
      <div class="picbox"><img src="../ASSETS/Photos/watch.png" alt=""></div>
      <div class="time">Time remaining: 02:15:43</div>
      <button>Bid Now</button>
    </div>
    <div class="item">
      <h3>Antique Vase</h3>
      <div class="picbox"><img src="../ASSETS/Photos/vase.png" alt=""></div>
      <div class="time">Time remaining: 05:42:10</div>
      <button>Bid Now</button>
    </div>
    <div class="item">
      <h3>Old Painting</h3>
      <div class="picbox"><img src="../ASSETS/Photos/painting.png" alt=""></div>
      <div class="time">Time remaining: 00:59:21</div>
      <button>Bid Now</button>
    </div>
  </div>

<label for="expand"><h2>More Items</h2></label>
<input type="checkbox" name="expand" id="expand">
    <div class="more-items">
    <div class="item">
      <h3>Vintage Watch</h3>
      <div class="picbox"><img src="../ASSETS/Photos/watch.png" alt=""></div>
      <div class="time">Time remaining: 02:15:43</div>
      <button>Bid Now</button>
    </div>
    <div class="item">
      <h3>Antique Vase</h3>
      <div class="picbox"><img src="../ASSETS/Photos/vase.png" alt=""></div>
      <div class="time">Time remaining: 05:42:10</div>
      <button>Bid Now</button>
    </div>
    <div class="item">
      <h3>Old Painting</h3>
      <div class="picbox"><img src="../ASSETS/Photos/painting.png" alt=""></div>
      <div class="time">Time remaining: 00:59:21</div>
      <button>Bid Now</button>
    </div>
    <div class="item">
      <h3>Vintage Watch</h3>
      <div class="picbox"><img src="../ASSETS/Photos/watch.png" alt=""></div>
      <div class="time">Time remaining: 02:15:43</div>
      <button>Bid Now</button>
    </div>
    <div class="item">
      <h3>Antique Vase</h3>
      <div class="picbox"><img src="../ASSETS/Photos/vase.png" alt=""></div>
      <div class="time">Time remaining: 05:42:10</div>
      <button>Bid Now</button>
    </div>
    <div class="item">
      <h3>Old Painting</h3>
      <div class="picbox"><img src="../ASSETS/Photos/painting.png" alt=""></div>
      <div class="time">Time remaining: 00:59:21</div>
      <button>Bid Now</button>
    </div>
    <div class="item">
      <h3>Vintage Watch</h3>
      <div class="picbox"><img src="../ASSETS/Photos/watch.png" alt=""></div>
      <div class="time">Time remaining: 02:15:43</div>
      <button>Bid Now</button>
    </div>
    <div class="item">
      <h3>Antique Vase</h3>
      <div class="picbox"><img src="../ASSETS/Photos/vase.png" alt=""></div>
      <div class="time">Time remaining: 05:42:10</div>
      <button>Bid Now</button>
    </div>
    <div class="item">
      <h3>Old Painting</h3>
      <div class="picbox"><img src="../ASSETS/Photos/painting.png" alt=""></div>
      <div class="time">Time remaining: 00:59:21</div>
      <button>Bid Now</button>
    </div>
  </div>

  <h2>Your Account</h2>
  <div class="account-info">
    <p><strong>Credits Left:</strong> 1,250.00 units</p>
    <h3>Recently Won Bids</h3>
    <ul class="recent-wins">
      <li>Classic Lamp – 220 units</li>
      <li>Bronze Statue – 460 units</li>
      <li>Retro Camera – 180 units</li>
    </ul>
  </div>
</main>

<div class="foot">
        <div class="topfoot">
            <div class="logo"><img src="../ASSETS/Photos/LogoKunst.png" alt="image failed to load"></div>
            <div class="contacts">Email: <a href="mailto:Yx6VW@example.com">Yx6VW@example.com</a> <br> Phone: <a href="tel:+25470000000">+25470000000</a></div>
            <div class="socials">
                <b>Follow Us: @KunstConnoisseur2025</b>
                <div class="s1"><img src="../ASSETS/Photos/download__1_-removebg-preview.png" alt=""></div>
                <div class="s1"><img src="../ASSETS/Photos/download__2_-removebg-preview.png" alt=""></div>
                <div class="s1"><img src="../ASSETS/Photos/download__3_-removebg-preview.png" alt=""></div>
                <div class="s1"><img src="../ASSETS/Photos/pngtree-instagram-logo-icon-png-image_3588821-removebg-preview.png" alt=""></div>
            </div>
        </div>
        <div class="bottomfoot">
            <button onclick="document.getElementById('termsPopup').style.display='block'" 
            style="padding:10px 15px; background:linear-gradient(90deg, rgba(255, 0, 255, 0.205), rgba(0, 255, 255, 0.164)); border:none; color:white; border-radius:5px; cursor:pointer;">
            Terms & Conditions
            </button>
            <button onclick="document.getElementById('privPopup').style.display='block'" 
            style="padding:10px 15px; background:linear-gradient(90deg, rgba(255, 0, 255, 0.205), rgba(0, 255, 255, 0.164)); border:none; color:white; border-radius:5px; cursor:pointer;">
            Privacy Policy
            </button>
            <button onclick="document.getElementById('refPopup').style.display='block'" 
            style="padding:10px 15px; background:linear-gradient(90deg, rgba(255, 0, 255, 0.205), rgba(0, 255, 255, 0.164)); border:none; color:white; border-radius:5px; cursor:pointer;">
            Refund Policy
            </button>
            <a href="./shipping.html"><button  style="padding:10px 15px; background:linear-gradient(90deg, rgba(255, 0, 255, 0.205), rgba(0, 255, 255, 0.164)); border:none; color:white; border-radius:5px; cursor:pointer;">Shipping and Handling</button></a>
            <a href="./account.html"><button style="padding:10px 15px; background:linear-gradient(90deg, rgba(255, 0, 255, 0.205), rgba(0, 255, 255, 0.164)); border:none; color:white; border-radius:5px; cursor:pointer;">My Account</button></a>
            <a href="./help.html"><button style="padding:10px 15px; background:linear-gradient(90deg, rgba(255, 0, 255, 0.205), rgba(0, 255, 255, 0.164)); border:none; color:white; border-radius:5px; cursor:pointer;">Help | FAQ</button></a>
            <button onclick="document.getElementById('newsPopup').style.display='block'" 
            style="padding:10px 15px; background:linear-gradient(90deg, rgba(255, 0, 255, 0.205), rgba(0, 255, 255, 0.164)); border:none; color:white; border-radius:5px; cursor:pointer;">
            Newsletter
            </button>
        </div>
    </div>


    <!--  terms-->
<div id="termsPopup" 
style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; overflow-y: scroll;">

  <!--box -->
  <div style="background:white; width:80%; max-width:500px; margin:100px auto; padding:20px; border-radius:10px; position:relative; ">
    
    <!-- okie button din -->
    <span onclick="document.getElementById('termsPopup').style.display='none'" 
    style="position:absolute; top:10px; right:15px; font-size:20px; cursor:pointer; font-weight:bold;">&times;</span>

    <h2 style="text-align:center; margin-top:0;">Terms & Conditions</h2>
    <p style="line-height:1.6; color:#333;">
      By using this auction platform, you agree to abide by all bidding rules, payment terms, and item ownership regulations. 
      All bids are final and binding once placed. Fraudulent or abusive activity may result in account suspension.
    </p>
    <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo molestias magni eius, delectus provident neque minus perspiciatis sunt, modi voluptatibus soluta suscipit, ut nisi atque earum! Aut voluptas quod saepe, repudiandae, provident aliquam quidem ullam dicta inventore necessitatibus iste, repellat laborum. Sint porro asperiores alias dolor iusto eius dolorum consequatur ipsam, aliquam consequuntur exercitationem et! At, sunt aperiam voluptate enim, libero, architecto in error deleniti nemo ducimus eveniet? Ullam maiores quis dolor, rem assumenda a aut. Autem perferendis commodi dicta esse fuga suscipit voluptates doloribus, doloremque sed natus cumque. Saepe repellendus perspiciatis enim dicta, expedita eveniet quae voluptas consectetur quam!
    </p>
    <p style="line-height:1.6; color:#333;">
      The platform reserves the right to modify terms without prior notice. Please review this page regularly for updates.
    </p>

    <!-- okie button -->
    <button onclick="document.getElementById('termsPopup').style.display='none'" 
    style="display:block; margin:20px auto 0; padding:10px 15px; background:magenta; color:white; border:none; border-radius:5px; cursor:pointer;">
      I Understand
    </button>
  </div>
</div>

<!-- privacy-->
<div id="privPopup" 
style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; overflow-y: scroll;">

  <!--box -->
  <div style="background:white; width:80%; max-width:500px; margin:100px auto; padding:20px; border-radius:10px; position:relative; ">
    
    <!-- okie button din -->
    <span onclick="document.getElementById('privPopup').style.display='none'" 
    style="position:absolute; top:10px; right:15px; font-size:20px; cursor:pointer; font-weight:bold;">&times;</span>

    <h2 style="text-align:center; margin-top:0;">Privacy Policy</h2>
    <p style="line-height:1.6; color:#333;">
      By using this auction platform, you agree to abide by all bidding rules, payment terms, and item ownership regulations. 
      All bids are final and binding once placed. Fraudulent or abusive activity may result in account suspension.
    </p>
    <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo molestias magni eius, delectus provident neque minus perspiciatis sunt, modi voluptatibus soluta suscipit, ut nisi atque earum! Aut voluptas quod saepe, repudiandae, provident aliquam quidem ullam dicta inventore necessitatibus iste, repellat laborum. Sint porro asperiores alias dolor iusto eius dolorum consequatur ipsam, aliquam consequuntur exercitationem et! At, sunt aperiam voluptate enim, libero, architecto in error deleniti nemo ducimus eveniet? Ullam maiores quis dolor, rem assumenda a aut. Autem perferendis commodi dicta esse fuga suscipit voluptates doloribus, doloremque sed natus cumque. Saepe repellendus perspiciatis enim dicta, expedita eveniet quae voluptas consectetur quam!
    </p>
    <p style="line-height:1.6; color:#333;">
      The platform reserves the right to modify terms without prior notice. Please review this page regularly for updates.
    </p>

    <!-- okie button -->
    <button onclick="document.getElementById('privPopup').style.display='none'" 
    style="display:block; margin:20px auto 0; padding:10px 15px; background:magenta; color:white; border:none; border-radius:5px; cursor:pointer;">
      I Understand
    </button>
  </div>
</div>

<!--  refund-->
<div id="refPopup" 
style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; overflow-y: scroll;">

  <!--box -->
  <div style="background:white; width:80%; max-width:500px; margin:100px auto; padding:20px; border-radius:10px; position:relative; ">
    
    <!-- okie button din -->
    <span onclick="document.getElementById('refPopup').style.display='none'" 
    style="position:absolute; top:10px; right:15px; font-size:20px; cursor:pointer; font-weight:bold;">&times;</span>

    <h2 style="text-align:center; margin-top:0;">Refund Policy</h2>
    <p style="line-height:1.6; color:#333;">
      By using this auction platform, you agree to abide by all bidding rules, payment terms, and item ownership regulations. 
      All bids are final and binding once placed. Fraudulent or abusive activity may result in account suspension.
    </p>
    <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo molestias magni eius, delectus provident neque minus perspiciatis sunt, modi voluptatibus soluta suscipit, ut nisi atque earum! Aut voluptas quod saepe, repudiandae, provident aliquam quidem ullam dicta inventore necessitatibus iste, repellat laborum. Sint porro asperiores alias dolor iusto eius dolorum consequatur ipsam, aliquam consequuntur exercitationem et! At, sunt aperiam voluptate enim, libero, architecto in error deleniti nemo ducimus eveniet? Ullam maiores quis dolor, rem assumenda a aut. Autem perferendis commodi dicta esse fuga suscipit voluptates doloribus, doloremque sed natus cumque. Saepe repellendus perspiciatis enim dicta, expedita eveniet quae voluptas consectetur quam!
    </p>
    <p style="line-height:1.6; color:#333;">
      The platform reserves the right to modify terms without prior notice. Please review this page regularly for updates.
    </p>

    <!-- okie button -->
    <button onclick="document.getElementById('refPopup').style.display='none'" 
    style="display:block; margin:20px auto 0; padding:10px 15px; background:magenta; color:white; border:none; border-radius:5px; cursor:pointer;">
      I Understand
    </button>
  </div>
</div>

<!-- news-->
<div id="newsPopup" 
style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; overflow-y: scroll;">

  <!--box -->
  <div style="background:white; width:80%; max-width:500px; margin:100px auto; padding:20px; border-radius:10px; position:relative; ">
    
    <!-- okie button din -->
    <span onclick="document.getElementById('newsPopup').style.display='none'" 
    style="position:absolute; top:10px; right:15px; font-size:20px; cursor:pointer; font-weight:bold;">&times;</span>

    <h2 style="text-align:center; margin-top:0;">Newsletter</h2>
    
    <p style="line-height:1.6; color:#333;">
        Stay updated with the latest auctions, exclusive deals, and rare finds. Subscribe now and never miss a bid!
      Recieves our latest news and updates via allowing email notifications.

    </p>

    <!--notify -->
    <input type="checkbox" name="news" id="news"> 
    <label for="news">Notify me</label>
  </div>
</div>

</body>
</html>
