<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <script src="bootstrap/js/jquery.min.js"></script>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

      <script src="bootstrap/js/bootstrap.min.js"></script>

      <title>Contest data</title>

  <style type="text/css">
  	.imageHeight{
  		width: 300px;
  		height: 300px;
  		background-color: gray; 
  	}

  	.hovereffect {
	  width: 100%;
	  height: 100%;
	  float: left;
	  overflow: hidden;
	  position: relative;
	  text-align: center;
	  cursor: default;
	}

	.hovereffect .overlay {
	  position: absolute;
	  overflow: hidden;
	  width: 80%;
	  height: 80%;
	  left: 10%;
	  top: 10%;
	  border-bottom: 1px solid #FFF;
	  border-top: 1px solid #FFF;
	  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
	  transition: opacity 0.35s, transform 0.35s;
	  -webkit-transform: scale(0,1);
	  -ms-transform: scale(0,1);
	  transform: scale(0,1);
	}

	.hovereffect:hover .overlay {
	  opacity: 1;
	  filter: alpha(opacity=100);
	  -webkit-transform: scale(1);
	  -ms-transform: scale(1);
	  transform: scale(1);
	}

	.hovereffect img {
	  display: block;
	  position: relative;
	  -webkit-transition: all 0.35s;
	  transition: all 0.35s;
	}

	.hovereffect:hover img {
	  
	  filter: brightness(0.6);
	  -webkit-filter: brightness(0.6);
	}

	.hovereffect h2 {
	  text-transform: uppercase;
	  text-align: center;
	  position: relative;
	  font-size: 17px;
	  background-color: transparent;
	  color: #FFF;
	  padding: 1em 0;
	  opacity: 0;
	  filter: alpha(opacity=0);
	  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
	  transition: opacity 0.35s, transform 0.35s;
	  -webkit-transform: translate3d(0,-100%,0);
	  transform: translate3d(0,-100%,0);
	}

	.hovereffect a, .hovereffect p {
	  color: #FFF;
	  padding: 1em 0;
	  opacity: 0;
	  filter: alpha(opacity=0);
	  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
	  transition: opacity 0.35s, transform 0.35s;
	  -webkit-transform: translate3d(0,100%,0);
	  transform: translate3d(0,100%,0);
	}

	.hovereffect:hover a, .hovereffect:hover p, .hovereffect:hover h2 {
	  opacity: 1;
	  filter: alpha(opacity=100);
	  -webkit-transform: translate3d(0,0,0);
	  transform: translate3d(0,0,0);
	}
  </style>
</head>
<body>

<div class="container">

	<div class="row">
	  	<div class="col-md-4 col-md-offset-4  imageHeight">
	  		<div class="hovereffect">
	  			<img src="image/sir.jpg" class="img-responsive"  alt="Image of Dr. Mohammad Shoyaib" width="300px" height="300px" > 
	  			<div class="overlay">
	                <h2>Dr. Mohammad Shoyaib </h2>
					<p>
						Professor<br>
						University Of Dhaka
					</p>
            </div>
	  	</div>
	  </div>

  	</div>

	  	<div class="row">
		  	<div class="col-md-4 imageHeight">
		  		<div class="hovereffect">
	  				<img src="image/hasan.jpg" class="img-responsive"  alt="Image of Hasan" width="300px" height="300px" > 
	  					<div class="overlay">
			                <h2>MD. Hasan Tarek </h2>
							<p>
								Roll: 818<br>
								BSSE 8th Batch
							</p>
            			</div>
		  		</div>
		  	</div>
		  	<div class="col-md-4 col-md-offset-4 imageHeight">
		  		<div class="hovereffect">
	  				<img src="image/shihab.jpg" class="img-responsive"  alt="Image of Hasan" width="300px" height="300px" > 
	  					<div class="overlay">
			                <h2>Shayakh Shihab Uddin </h2>
							<p>
								Roll: 813<br>
								BSSE 8th Batch
							</p>
            			</div>
		  		</div>
  			</div>
  
	</div>

</body>
</html>
