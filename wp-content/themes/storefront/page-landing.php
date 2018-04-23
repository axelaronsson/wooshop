<head>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <style>
        body {
            margin: 0px;
        }
        #smide-header {
            height: 50vh;
            background: lightseagreen;
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
    <div id="smide-header"></div>
    <p>{{ message }}</p>
    <button v-on:click="reverseMessage">Reverse Message</button>
    <p><a href="localhost/wooshop/shop/">shop</a></p>
</div>
<script>
var app5 = new Vue({
  el: '#app-5',
  data: {
    message: 'Hello Vue.js!',
	wpdata: "<div id='foo'><a href='#'>Link</a><span></span></div>"
  },
  methods: {
    reverseMessage: function () {
      this.message = this.message.split('').reverse().join('')
    }
  },
  computed: {
  },
  beforeMount: function () {
    var theURL = window.location.href;
    var parts = theURL.split('/');
    var slug = parts[4];
    var theData = []
	fetch('http://localhost/wooshop/wp-json/wp/v2/pages/?slug=' + slug)
	.then(function(response) {
		return response.json();
	})
	.then(function(myJson) {
		console.log(myJson);
        theData.push(myJson);
	});
    this.wpdata = theData
    var content = this.wpdata
    console.log('data', Object.entries(content))
    // var xmlString = content
    // var parser = new DOMParser()
    // var doc = parser.parseFromString(xmlString, "text/xml")
    // var imgTag = doc.getElementByTagName('img')
    // console.log(imgTag)
  }
})
</script>