<?php
$imgOne = get_field('section_one_image');
$headingOne = get_field('section_one_heading');
$textOne = get_field('section_one_text');
$imgTwo = get_field('section_two_image');
$imgThree = get_field('section_three_image_one');
$imgFour = get_field('section_three_image_two');
$tripletOne = get_field('triplet_one');
$tripletTwo = get_field('triplet_two');
?>
<head>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  <style>
      body {
        margin: 0px;
      }
      h2 {
        font-weight: lighter;
        font-size: 36px;
        font-family: sans-serif;
      }
      .link {
        font-weight: bold;
        text-decoration: underline;
        color: black;
      }
      .thin {
        font-weight: lighter;
      }
      #smide-header {
        height: 100vh;
        /* background-image: url('../wp-content/themes/storefront/pics/4359.jpg'); */
        background-size: cover;
        background-position: center;
      }
      #smide-section-one {
        height: 100vh;
        background-image: url('../wp-content/themes/storefront/pics/4358.jpg');
        background-size: cover;
        background-position: center;
      }
      #smide-section-two {
        height: 100vh;
      }
      #smide-section-two > div:nth-child(1) {
        height: 100%;
        width: 50%;
        float: left;
        background-size: cover;
        background-position: center;
      }
      #smide-section-two > div:nth-child(2) {
        height: 100%;
        width: 50%;
        float: right;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #eddbcb;
      }
      #section-two-right-content {
        width: 70%;
      }
      #section-two-right-image {
        height: 40%;
        background-size: contain;
        background-repeat: no-repeat;
      }
      #smide-nav {
        display: flex;
      }
      #smide-nav li, a {
        font-family: sans-serif;
        text-decoration: none;
        color: black;
        font-weight: bold;
        flex: 1;
      }
      #header-img {
        height: 200px;
        width: auto;
      }
      .right-col {
        padding-top: 30px;
        width: 50%;
        float: right;
      }
      #smide-header-text {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        font-family: sans-serif;
        width: 600px;
        height: 70%;
      }
      #section-one-text {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        font-family: sans-serif;
        width: 600px;
        height: 30%;
      }
      #webshop {
        margin-left: 10px;
      }
      #columns {
        height: 100vh;
        display: flex;
      }
      .thirds {
        flex: 1;
        background-size: cover;
        background-position: center;
      }
  </style>
</head>
<div
  id="app-5"
  style=""
>
  <div id="smide-header" style="background-image: url(<?php echo $imgOne; ?>)">
    <div class="right-col">
      <div id="smide-nav">
        <a href="#">Butiken</a>
        <a href="#">Shop</a>
        <a href="#">Vigsel</a>
        <a href="#">Om oss</a>
      </div>
      <div id="smide-header-text">
        <h2><?php echo $headingOne ?></h2>
        <p><?php echo $textOne ?></p>
        <p><a class="link" href="">Utforska utbudet i vår butik</a></p>
      </div>
    </div>
  </div>
  <div id="smide-section-one" style="background-image: url(<?php echo $imgTwo; ?>)">
    <div class="right-col">
      <div id="section-one-text">
        <h2>Lorem ipsum, dolor sit amet consect adipisicing elit. Reiciendis, adipisci.</h2>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor, perferendis!</p>
      </div>
    </div>
  </div>
  <div id="smide-section-two">
    <div style="background-image: url(<?php echo $imgThree; ?>)"></div>
    <div>
      <div id="section-two-right-content">
        <h2>Sedan 1985 har vi tillverkat smycken på Hornsgatspuckeln</h2>
        <div id="section-two-right-image" style="background-image: url(<?php echo $imgFour; ?>)"></div>
      </div>
    </div>
  </div>
  <div id="webshop">
    <h2>I vår webbshop. <a class="link thin" href="">Se hela utbudet till försäljning online.</a></h2>
  </div>
  <div id="columns">
    <div class="thirds" style="background-image: url(<?php echo $tripletOne; ?>)"></div>
    <div class="thirds" style="background:#cbeddb;"></div>
    <div class="thirds" style="background:#efbfbe;"></div>
  </div>
</div>
<script>

var app5 = new Vue({
  el: '#app-5',
  data: {
    message: 'Hello Vue.js!',
	  wpdata: "<div id='foo'><a href='#'>Link</a><span></span></div>",
    pageImages: null,
    headerpic: window.imageOne
  },
  methods: {
    reverseMessage: function () {
      this.message = this.message.split('').reverse().join('')
    },
    theImages: function (data) {
      var parser, xmlDoc
      var text = data.content.rendered
      parser = new DOMParser()
      xmlDoc = parser.parseFromString(text,"text/xml")
      var elems = xmlDoc.getElementsByTagName('img')
      this.pageImages = elems
      console.log('method', elems)
    }
  },
  computed: {
      theContent: function () {
        return this.wpdata.content.rendered
    }
  },
  beforeMount: function () {
    var theURL = window.location.href
    var parts = theURL.split('/')
    var slug = parts[4]
    var that = this

    fetch('http://localhost/wooshop/wp-json/wp/v2/pages/?slug=' + slug)
    .then(function(response) {
      return response.json()
    })
    .then(function(myJson) {
      console.log(myJson[0])
      that.wpdata = myJson[0]
      that.theImages(myJson[0])
    })
  }
})
</script>