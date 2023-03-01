<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>{{$data["meta"]["name"]}}</title>
	<link rel="stylesheet" href={{ asset("css/main.css") }} />
	<style>

		.section-name {
			color: purple;
			text-transform: uppercase;
			position: relative;
			right: calc( 100% + 1rem);
			padding: 0 0.5rem;
			text-align: right;
		}

		.skill-section {
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
			height: 100%;
		}

		#main-container {
			max-width: 40rem; /*50rem*/
			width: 100vw; /* - Max 40, scales to screen width if smaller -*/
			height: 100%;
			padding-top: 4rem;
			box-shadow: 0 0 5px purple;
			background-color: purple;
			color: white;
		}

		.title {
			margin-block: 1rem;
			text-align: center;
			text-transform: full-width uppercase;
		}

		#skills, #works, #projects, #courses, #education {
			display: flex;
			flex-direction: column;
			margin: 1rem 0.5rem;
		}

		.work {
			margin: 1rem 0.5rem;
			border-top: 1px solid white;
		}

		.work > p {
			padding: 0.5rem;
		}

		.work > .work-title {
			display: flex;
			align-items: center;
			font-size: larger;
			position: relative;
			top: -0.5rem;
			height: 1rem;
		}

			.work > .work-title > .date {
				margin-left: auto;
				font-size: medium;
			}

        	.work > .work-title > * {
				background-color: purple;
				padding: 0 0.5rem;
        	}

		#projects {
			background-color: white;
			color: purple;
			/*box-shadow: 0 0 5px purple inset;*/
			margin-inline: 0px;
		}

		.project {
			border-top: 1px solid purple;
			margin: 1rem 0.5rem;
		}

			.project > p {
				text-align: center;
				margin-bottom: 1rem;
			}

		.project-name {
			background-color: white;
			color: purple;
			font-size: 1rem;
			position: relative;
			top: -1rem;
			line-height: 2rem;
			padding: 0 1rem;
		}

		#education {
			text-align: center;
		}

		.education {
			margin-block: 0.5rem;
		}

		.course {
			color: white;
		}

			.course * {
				color: white;
			}
	</style>
</head>
<body>
	<header>
		@php
			 $meta = $data["meta"]
		@endphp
		<h3 id="head-name">{{$meta["name"]}}</h3>
		<div id="head-icons">
			@isset($meta["media"]["linkedin"])
			<a href="{{$meta["media"]["linkedin"]}}">
				<ion-icon size="large" name="logo-linkedin"></ion-icon>
			</a>
			@endisset
			@isset($meta["media"]["github"])
			<a href="{{$meta["media"]["github"]}}">
				<ion-icon size="large" name="logo-github"></ion-icon>
			</a>
			@endisset
			@isset($meta["media"]["phone"])
			<a href="tel:{{$meta["media"]["phone"]}}">
				<ion-icon size="large" name="call"></ion-icon>
			</a>
			@endisset
			@isset($meta["media"]["email"])
			<a href="mailto:{{$meta["media"]["email"]}}">
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
					@isset($data["skills"]["categories"]) {{-- Sections of development data --}}
					@foreach ($data["skills"]["categories"] as $section)
					<h3 class="section-name">{{$section["category"]}}</h3>
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
			@isset($data["projects"])
				<h1 class="title">Projects</h1>
				<div id="projects">
					@foreach ($data["projects"] as $project)
						<div class="project">
							@if(isset($project["url"]))
								<a class="project-name" href="{{$project["url"]}}">{{$project["title"]}}</a>
							@else
								<span class="project-name">{{$project["title"]}}</span>
							@endif
							<p>{{$project["description"]}}</p>
							@isset($project["skills"])
							<div class="dev-tag-container">
								@foreach ($project["skills"] as $skill)
								<dev-tag name="{{$skill}}" color="purple" background-color="white"></dev-tag>
								@endforeach
							</div>
							@endisset
						</div>
					@endforeach
				</div>
			@endisset
			@isset($data["work-expirience"])
				<h1 class="title">Work Expirience</h1>
				<div id="works">
				@foreach($data["work-expirience"] as $work)
					<div class="work">
						<div class="work-title"><p>{{$work["position"]}} at {{$work["company"]}}</p><p class="date">{{$work["time"]}}</p></div>
                        @isset($work["description"])
							<p>{{$work["description"]}}</p>
                        @endisset
						@isset($work["details"])
							<ul class="dashed">
								@foreach($work["details"] as $detail)
									<li>{{$detail}}</li>
								@endforeach
							</ul>
						@endisset
					</div>
				@endforeach
				</div>
			@endisset
			@isset($data["education"])
				<h1 class="title">Education</h1>
			<div id="education">
                @foreach($data["education"] as $edu)
					<div class="education">
						<h3>{{$edu["title"]}} at {{$edu["school"]}} - {{$edu["graduation"]}}</h3>
						<p>{{$edu["description"]}}</p>
					</div>
				@endforeach
			</div>
			@endisset
            @isset($data["courses"])
				<h1 class="title">Courses</h1>
				<div id="courses">
					<ul class="dashed">
						@foreach($data["courses"] as $course)
							@if(isset($course["url"]))
								<li><a class="course" href="{{$course["url"]}}">{{$course["name"]}} ({{$course["date"]}})</a></li>
							@else
								<li class="course">{{$course["name"]}} ({{$course["date"]}})</li>
							@endif
						@endforeach
					</ul>
				</div>
            @endisset
		</div>
	</main>
	<script src={{ asset("js/customs.js") }}></script>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
