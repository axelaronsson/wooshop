<head>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  <style>
  div {
    background-repeat: no-repeat;
  }
  </style>
</head>
<div
  id="butiken"
  style=""
>
    <div v-if="pageImages" v-for="elem in pageImages">
    <img v-bind:style="{ 'height': shuffleHeight(), 'margin-left': shuffleMargin() }" v-bind:src="elem.src" alt="">
    </div>
    <!-- <img v-if="pageImages" v-bind:src="pageImages[0].attributes.src.value" alt=""> -->
    <!-- <img id="header-img" src="" alt=""> -->
</div>
<script>
//{ backgroundImage: 'url(' + elem.src + ')', { border: 1px solid yellow }
var butiken = new Vue({
  el: '#butiken',
  data: {
    message: 'Hello Vue.js!',
	  wpdata: "<div id='foo'><a href='#'>Link</a><span></span></div>",
    pageImages: null,
    previousNum: null
  },
  methods: {
    reverseMessage: function () {
      this.message = this.message.split('').reverse().join('')
    },
    theImages: function (data) {
      var parser, xmlDoc
      var text = data.content.rendered
      parser = new DOMParser()
      xmlDoc = parser.parseFromString(text,"text/html")
      var elems = xmlDoc.getElementsByTagName('img')
      this.pageImages = elems
      console.log('method', this.pageImages[0].src)
    },
    shuffleHeight: function () {
      var nmbr = Math.floor(Math.random() * 20) + 15
      if (nmbr == this.previousNum) {
        nmbr += 1
      }
      this.previousNum = nmbr
      realSize = nmbr * 10
      return realSize
    },
    shuffleMargin: function () {
      var nmbr = Math.floor(Math.random() * 40) + 0
      if (nmbr == this.previousNum) {
        nmbr += 1
      }
      this.previousNum = nmbr
      realSize = nmbr + '%'
      return realSize
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
      console.log(myJson)
      that.wpdata = myJson[0]
      that.theImages(myJson[0])
    })
  }
})
</script>