<div><h1>Gallery</h1></div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>
<style class="cp-pen-styles">body { 
  font-family: Avenir, sans-serif; margin: 0; 
  background-color: #121;
}
div#quad { 
  background-color: #000; 
  font-size: 0; width: 60%; 
  margin: 0 auto;
  box-shadow: 0 0 12px rgba(0,0,0,0.8);
}
div#quad figure { 
  margin: 0; width: 50%; 
  height: auto; transition: 1s; 
  display: inline-block; 
  position: relative; overflow: hidden; 
}
div#quad figure:hover { cursor: pointer; z-index: 4; }
div#quad figure img { width: 100%; height: auto; }
div#quad figure:nth-child(1) { transform-origin: top left; }
div#quad figure:nth-child(2) { transform-origin: top right; }
div#quad figure:nth-child(3) { transform-origin: bottom left; }
div#quad figure:nth-child(4) { transform-origin: bottom right; }
div#quad figure figcaption { 
  margin: 0; opacity: 0; 
  background: rgba(0,0,0,0.3); 
  color: #fff; padding: .3rem; 
  font-size: 1.2rem; 
  position: absolute; 
  bottom: 0; width: 100%;
	transition: 1s 1s opacity; 
}
.expanded { transform: scale(2); z-index: 5;  }
div#quad figure.expanded figcaption { opacity: 1; }
div.full figure:not(.expanded) { pointer-events: none; }</style>
<div id="quad">
  <figure>
  <img src="images/gal1.jpg">
  
  </figure>
  <figure>
    <img src="images/galx.jpg" >
  </figure>
  <figure>
    <img src="images/gal3.jpg">
  </figure>
  <figure>
    <img src="images/gal4.jpg">
  </figure>
</div>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script >var quadimages = document.querySelectorAll("#quad figure");
for(i=0; i<quadimages.length; i++) {if (window.CP.shouldStopExecution(1)){break;}
  quadimages[i].addEventListener('click', function(){ this.classList.toggle("expanded"); quad.classList.toggle("full") }); 
}
window.CP.exitedLoop(1);
</script>