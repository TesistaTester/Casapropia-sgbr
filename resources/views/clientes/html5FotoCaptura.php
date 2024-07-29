		<form enctype="multipart/form-data" id="form-nuevo-cliente" action="{{url('clientes')}}" method="POST" data-validation1="{{url('clientes/valida_cliente')}}">
			@csrf
			<div class="col-md-12">
				<label class="label-blue label-block" for="">
					Fotografía cliente:
					<span class="text-danger">*</span>
					<i class="fa fa-question-circle float-right" title="Establecer la fotografía del cliente"></i>
				</label>
				<div class="text-center">
					<canvas id="foto-snap" width="320" height="320" style=""></canvas>
				</div>

				<input type="file" name="cli_foto" id="cli_foto" accept="image/*">
				<button type="submit">Enviar</button>
				<button id="apaga" type="button">Apaga camara</button>
			</div>
		</form>


	<!-- capturador en video -->
	<video id="player" autoplay></video>
	<button id="capture">Capturar</button>
	<canvas id="canvas" width="320" height="320"></canvas>
	<script>
	  const player = document.getElementById('player');
	  const canvas = document.getElementById('canvas');
	  const canvas2 = document.getElementById('foto-snap');
	  const context = canvas.getContext('2d');
	  const context2 = canvas2.getContext('2d');
	  const captureButton = document.getElementById('capture');
	  const apaga = document.getElementById('apaga');
	
	  const constraints = {
		video: true,
	  };
	
	  captureButton.addEventListener('click', () => {
		//Dibujar el frame en el canvas.
		context.drawImage(player, 0, 0, canvas.width, canvas.height);
		context2.drawImage(player, 0, 0, canvas.width, canvas.height);

		//convierte en archivo y envia
		canvas.toBlob( (blob) => {
			const file = new File( [ blob ], "foto_cliente.png" );
			const dT = new DataTransfer();
			dT.items.add( file );
			document.querySelector('#cli_foto').files = dT.files;
		} );

	});

	apaga.addEventListener('click', () => {
		player.srcObject.getTracks()[0].stop();
	});
	  

	  // Attach the video stream to the video element and autoplay.
	  navigator.mediaDevices.getUserMedia(constraints).then((stream) => {
		player.srcObject = stream;
	  });


	</script>


{{-- <form method="POST">
		<input type="file" name="file"><br>
		<button>submit</button> (check your dev tools network panel to see the File is sent)
	  </form>
	  <br>
	  <button id="test">
		load input's content as image
	  </button>
	  
	  <script>
// draw on the canvas
const canvas = document.createElement( "canvas" );
const ctx = canvas.getContext( "2d" );
ctx.fillStyle = "red";
ctx.fillRect( 20, 20, 260, 110 );

// convert to Blob (async)
canvas.toBlob( (blob) => {
  const file = new File( [ blob ], "mycanvas.png" );
  const dT = new DataTransfer();
  dT.items.add( file );
  document.querySelector( "input" ).files = dT.files;
} );

// to prove the image is there
document.querySelector( "#test" ).onclick = (evt) => {
  const file = document.querySelector( "input" ).files[ 0 ];
  document.body.appendChild( new Image() )
    .src = URL.createObjectURL( file );
};		
	  </script> --}}
