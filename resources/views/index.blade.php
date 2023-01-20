<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="UTF-8">
		<title>Laravel Image Optimizer</title>
		<meta name="designer" content="Nima jahan bakhshian | dvlpr1996">
		<meta name="owner" content="Nima jahan bakhshian | dvlpr1996">
		<meta name="author" content="Nima jahan bakhshian | dvlpr1996">
		<meta name="language" content="en">
		<meta name="robots" content="index, follow">
		<meta name="keywords" content="laravel, Optimizer, php, web design">
		<meta name="description" content="compress images and minify css, js and html files">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicon.ico') }}">
		<meta name="theme-color" content="#2F80ECff">
		<meta name="msapplication-navbutton-color" content="#2F80ECff">
		<meta name="apple-mobile-web-app-status-bar-style" content="#2F80ECff">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
		@vite('resources/css/app.css')
		<!-- [if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<![endif] -->
</head>

<body class="bg-primary px-4 sm:px-0 font-['Open_Sans'] capitalize">
		<main class="flex min-h-screen items-center justify-center p-4">
				<div class="w-[500px] rounded-xl bg-white p-5 text-center">

						<div class="space-y-3 text-center">
								<h1 class="text-4xl">file Optimizer</h1>
								<p class="mx-auto w-full text-lg sm:w-3/4">
										upload your image to compress them or upload css js file to minify them
								</p>
						</div>

						<div class="my-6 mx-auto">
								<div class="uploader">
										<form action="" method="POST" id="uploader" enctype="multipart/form-data"
												class="flex h-full flex-col items-center justify-center gap-5">
												@csrf
												<i id="icon" class="fa fa-upload text-5xl"></i>
												<input type="file" name="files[]" id="file-input"
														class="absolute top-0 left-0 m-0 h-full w-full cursor-pointer p-0 opacity-0 outline-0"
														accept="image/png, image/jpeg ,text/html, text/javascript, text/css" multiple>
                            
												<div class="select-none">
														<h3>Drag and drop your files or click here</h3>
												</div>
										</form>
								</div>

								<button type="submit" name="upload" class="btn" form="uploader">upload</button>
						</div>

				</div>
		</main>

		<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
		@vite('resources/js/app.js')
		<noscript>your browser does not support the javascript</noscript>
</body>

</html>
