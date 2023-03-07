<div>
	<style>
		body {
			margin: 0;
			padding: 0;
		}

		/* Side navigation */
		.sidenav {
			height: 100%;
			width: 100px;
			position: fixed;
			z-index: 1;
			top: 0;
			left: 0;
			background-color: #265525;
			overflow-x: hidden;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			transition: width 0.5s;
		}

		/* Avatar container */
		.avatar-container {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-bottom: 10px;
			opacity: 0.8;
		}

		/* Avatar */
		.avatar {
			border-radius: 50%;
			height: 50px;
			width: 50px;
		}

		/* Avatar caption */
		.avatar-caption {
			color: #fff;
			font-size: 18px;
			margin-top: 5px;
			text-align: center;
		}

		/* Links inside the navigation */
		.sidenav a {
			padding: 6px 8px 6px 16px;
			text-decoration: none;
			font-size: 25px;
			color: #818181;
			display: block;
		}

		/* Change color on hover */
		.sidenav a:hover {
			color: #f1f1f1;
		}

		/* Pop-out side navigation */
		.sidenav:hover {
			width: 200px;
		}

		.sidenav:hover a:not(:first-child) {
			opacity: 1;
		}

		.sidenav:hover .nav-text {
			display: inline;
		}

		.nav-text {
			display: none;
			font-size: 18px;
			color: #f1f1f1;
			margin-left: 10px;
		}

		.nav-text a {
			padding: 6px 8px 6px 16px;
			text-decoration: none;
			color: #f1f1f1;
			display: block;
			opacity: 0;
			transition: opacity 0.5s;
		}

		.logout-link {
			font-size: 14px;
		}
	</style>
	<div class="sidenav">
		<div class="avatar-container">
			<img src="{{asset('/storage/user-logo.jpg')}}" alt="Avatar" class="avatar">
			<div class="avatar-caption">{{Str::ucfirst(auth()->user()->name)}}</div>
		</div>
		<div class="logout-button">
			<a class="logout-link" href="/logout">Logout</a>
		</div>
	</div>
</div>