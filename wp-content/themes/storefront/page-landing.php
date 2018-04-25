<head>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  <style>
      body {
        margin: 0px;
      }
      #smide-header {
        height: 100vh;
        background-image: url('../wp-content/themes/storefront/pics/4359.jpg');
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
        width: 50%;
        margin-top: 30px;
        float: right;
        justify-content: space-around;
      }
      #smide-nav li, a {
        /* display: inline; */
        font-family: sans-serif;
        text-decoration: none;
        color: white;
      }
  </style>
</head>
<div
	id="app-5"
	style="
    height: 100vh;
    width: 100%;
    background: mistyrose;
	"
    >
    <div id="smide-header">
      <div id="smide-nav">
        <a href="#">Butiken</a>
        <a href="#">Shop</a>
        <a href="#">Vigsel</a>
        <a href="#">Om oss</a>
      </div>
    </div>
    <div id="smide-section-one"></div>
    <div><img v-bind:src="pageImages[0].attributes.src.value" alt=""></div>
    <p><a href="localhost/wooshop/shop/">shop</a></p>
</div>
<script>
var app5 = new Vue({
  el: '#app-5',
  data: {
    message: 'Hello Vue.js!',
	  wpdata: "<div id='foo'><a href='#'>Link</a><span></span></div>",
    pageImages: null
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