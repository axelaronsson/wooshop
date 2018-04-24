<head>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <style>
        body {
            margin: 0px;
        }
        #smide-header {
            height: 50vh;
            background: palegreen;
        }
    </style>
</head>
<div
	id="skraddarsytt"
	style="
    height: 100vh;
    width: 100%;
    background: mistyrose;
	"
    >
    <div id="smide-header"></div>
    <p>{{ message }}</p>
    <!-- <p>{{ theContent }}</p> -->
    <button v-on:click="reverseMessage">Reverse Message</button>
    <p><a href="localhost/wooshop/shop/">shop</a></p>
</div>
<script>
var skraddarsytt = new Vue({
  el: '#skraddarsytt',
  data: {
    message: 'Hello Vue.js!',
	  wpdata: "<div id='foo'><a href='#'>Link</a><span></span></div>",
    pageImg: null
  },
  methods: {
    reverseMessage: function () {
      this.message = this.message.split('').reverse().join('')
    }
  },
  computed: {
      theContent: function () {
        return this.wpdata.content
    }
  },
  beforeMount: function () {
    var theURL = window.location.href;
    var parts = theURL.split('/');
    var slug = parts[4];
    var that = this
    var theData = 'lite data'

    fetch('http://localhost/wooshop/wp-json/wp/v2/pages/?slug=' + slug)
    .then(function(response) {
      return response.json();
    })
    .then(function(myJson) {
      console.log(myJson[0]);
      that.wpdata = myJson[0];
      theData = myJson[0]
    });
  }
})
</script>