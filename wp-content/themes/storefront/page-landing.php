<?php
$imgOne = get_field('section_one_image');
$headingOne = get_field('section_one_heading');
$textOne = get_field('section_one_text');
$imgTwo = get_field('section_two_image');
?>
<head>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  <style>
      body {
        margin: 0px;
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
      #smide-nav {
        display: flex;
      }
      #smide-nav li, a {
        /* display: inline; */
        font-family: sans-serif;
        text-decoration: none;
        color: white;
        flex: 1;
      }
      #header-img {
        height: 200px;
        width: auto;
      }
      #right-col {
        padding-top: 30px;
        width: 50%;
        float: right;
      }
      #section-one-text {
        font-family: sans-serif;
        width: 300px;
        margin-top: 50%;
      }
  </style>
</head>
<div
  id="app-5"
  style=""
>
    <div id="smide-header" style="background-image: url(<?php echo $imgOne; ?>)">
      <div id="right-col">
        <div id="smide-nav">
          <a href="#">Butiken</a>
          <a href="#">Shop</a>
          <a href="#">Vigsel</a>
          <a href="#">Om oss</a>
        </div>
        <div id="section-one-text">
          <h2><?php echo $headingOne ?></h2>
          <p><?php echo $textOne ?></p>
        </div>
      </div>
    </div>
    <div id="smide-section-one" style="background-image: url(<?php echo $imgTwo; ?>)"></div>
    <!-- <img v-if="pageImages" v-bind:src="pageImages[0].attributes.src.value" alt=""> -->
    <!-- <img id="header-img" src="" alt=""> -->
</div>
<script>
var app5 = new Vue({
  el: '#app-5',
  data: {
    message: 'Hello Vue.js!',
	  wpdata: "<div id='foo'><a href='#'>Link</a><span></span></div>",
    pageImages: null,
    headerpic: '<?php echo $headerimg; ?>'
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