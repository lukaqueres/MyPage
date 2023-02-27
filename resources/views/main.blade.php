<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>{{$data["name"]}}</title>
	<link rel="stylesheet" href={{ asset("css/main.css") }} />
	<style>

		.section-name {
			color: purple;
			text-transform: uppercase;
			transform:translateX(-100%);
			padding: 0 0.5rem;
			text-align: right;
			line-height: 1.5rem;
		}

		.skill-section {
        	padding: 1rem;
			border-top: 1px dashed purple;
			margin-inline: 0.5rem;
			transform: translateY(-1.5rem);
		}

        	.skill-section > .name {
        		text-transform: uppercase;
				transform:translateX(-100%);
				padding: 0 0.2rem;
        	}

		.dev-tag-container {
			display: flex;
			flex-wrap: wrap;
			/*justify-content: center;*/
		}

		dev-tag {
			margin-inline: 0.5rem;
		}

		main {
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		#main-container {
			max-width: 40rem; /*50rem*/
			width: 100vw;
			border-left: 1px solid purple;
			box-shadow: 0 0 5px purple;
		}

		.title {
			color: var(--accent-color);
			margin-block: 1rem;
			text-align: center;
		}

		#skills {
			/*display: grid;
        	grid-template-columns: minmax(20rem,1fr) minmax(20rem,1fr);
        				*/
			display: flex;
			flex-direction: column;
		}

		.work {
			margin: 1rem 0.5rem;
		}

		.work > .work-title {
			display: flex;
			align-items: center;
        	border-top: 1px solid var(--accent-color);
			padding: 0.5rem;
			color: var(--accent-color);
			font-size: larger;
		}

		.work > .work-title > .date {
			margin-left: auto;
			font-size: medium;
		}
	</style>
</head>
<body>
	<header>
		<h3 id="head-name">{{$data["name"]}}</h3>
		<div id="head-icons">
			@isset($data["media"]["linkedin"])
			<a href="{{$data["media"]["linkedin"]}}">
				<ion-icon size="large" name="logo-linkedin"></ion-icon>
			</a>
			@endisset
			@isset($data["media"]["github"])
			<a href="{{$data["media"]["github"]}}">
				<ion-icon size="large" name="logo-github"></ion-icon>
			</a>
			@endisset
			@isset($data["media"]["phone"])
			<a href="tel:{{$data["media"]["phone"]}}">
				<ion-icon size="large" name="call"></ion-icon>
			</a>
			@endisset
			@isset($data["media"]["email"])
			<a href="mailto:{{$data["media"]["email"]}}">
				<ion-icon size="large" name="mail"></ion-icon>
			</a>
			@endisset
		</div>
	</header>
	<main>
        <div id="main-container">
            @isset($data["skills"])
				<h1 class="title">Skills</h1>
				<div id="skills">
					@isset($data["skills"]["sections"]) {{-- Sections of development data --}}
					@foreach ($data["skills"]["sections"] as $section)
                    {{--<h3 class="name">{{$section["name"]}}</h3>--}}
                    <h3 class="section-name">{{$section["name"]}}</h3>
						<div class="skill-section">
							<div class="dev-tag-container">
								@foreach ($section["content"] as $element)
									@if(isset($element["level"]))
										<dev-tag name="{{$element["name"]}}" level={{$element["level"]}}></dev-tag>
									@else
										<dev-tag name="{{$element["name"]}}"></dev-tag>
									@endif
								@endforeach
							</div>
						</div>
					@endforeach
					@endisset
				</div>
            @endisset
            @isset($data["work-expirience"])
				<h1 class="title">Work Expirience</h1>
				@foreach($data["work-expirience"] as $work)
					<div class="work">
						<div class="work-title"><p>{{$work["position"]}} at {{$work["company"]}}</p><p class="date">{{$work["time"]}}</p></div>
						@isset($work["details"])
							<ul>
								@foreach($work["details"] as $detail)
									<li>{{$detail}}</li>
								@endforeach
							</ul>
						@endisset
					</div>
				@endforeach
            @endisset
            @isset($data["education"])
				<h1 class="title">Education</h1>
			@endisset
        </div>
	</main>
	<script src={{ asset("js/customs.js") }}></script>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
