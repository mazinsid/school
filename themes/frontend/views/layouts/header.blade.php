<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مدرسة الانشراح</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<script src="{{ mix('js/app.js', 'themes/frontend') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'themes/frontend') }}" rel="stylesheet">



    <link href="{{asset('css/tailwind.min.css')}}" rel="stylesheet"> <!--Replace with your tailwind.css once created-->
	<link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
	<link href="{{ asset('css/style.css')}}" rel="stylesheet" />
	 />

	
	<script src="{{ asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
		<style>
		.bg-black-alt  {
			background:#FFFFEE;
		}
		.text-black-alt  {
			color:#191919;
		}
		.border-black-alt {
			border-color: #191919;
		}
		
	</style>

</head>
<body class="bg-black-alt font-sans leading-normal tracking-normal" dir="rtl">

<nav id="header" class="bg-gray-900 fixed w-full z-10 top-0 shadow">
	

		<div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">
				
			<div class="w-1/2 pl-2 md:pl-0">
				<a class="text-gray-100 text-base xl:text-xl no-underline hover:no-underline font-bold"  href="#"> 
					<i class="fas fa-moon text-blue-400 pr-3"></i> 
				</a>
            </div>
			<div class="w-1/2 pr-0">
				<div class="flex relative inline-block float-right">
				
				  <div class="relative text-sm text-gray-100">
					  <button id="userButton" class="flex items-center focus:outline-none mr-3">
					{{auth()->user()->name}}
						<svg class="pl-2 h-2 fill-current text-gray-100" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129"><g><path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"/></g></svg>
					  </button>
					  <div id="userMenu" class="bg-gray-900 rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
						  <ul class="list-reset">
							<li><a href="#" class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline">My account</a></li>
							<li><a href="#" class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline">Notifications</a></li>
							<li><hr class="border-t mx-2 border-gray-400"></li>
							<li><a href="#" class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline"> <a href="{{ route('logout') }}"
								class="no-underline hover:underline"
								onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
							 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
								 {{ csrf_field() }}
							 </form></a></li>
						  </ul>
					  </div>
				  </div>


					<div class="block lg:hidden pr-4">
					<button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-100 hover:border-teal-500 appearance-none focus:outline-none">
						<svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
					</button>
				</div>
				</div>

			</div>


			<div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-900 z-20" id="nav-content">
				<ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
						@if (auth()->user()->IsٍParent())
					<li class="mr-6 my-2 md:my-0">
                        <a href="{{route('home')}}" class="block py-1 md:py-3 pl-1 align-middle text-blue-400 no-underline hover:text-gray-100 border-b-2 border-blue-400 hover:border-blue-400">
							   <i class="fas fa-home fa-fw mr-3 text-blue-400"></i><span class="pb-1 md:pb-0 text-sm">الرئسية</span>
                        </a>
                    </li>
					<li class="mr-6 my-2 md:my-0">
                        <a href="{{route('parent.students')}}" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-pink-400">
                            <i class="fas fa-tasks fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">الطلاب المسجيلين</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a  href="{{route('student.create')}}" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-purple-400">
                            <i class="fa fa-envelope fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">أضافة طالب جديد</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-green-400">
                            <i class="fas fa-chart-area fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">الاقساط</span>
                        </a>
					</li>
					@endif
					@if (auth()->user()->IsٍStudent())
					<li class="mr-6 my-2 md:my-0">
						<a href="{{route('schedule.student')}}" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline 
						hover:text-gray-100 border-b-2 border-gray-900
						 hover:border-red-400">
							<i class="fa fa-wallet fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">الجدول الاسبوعي</span>
                        </a>
					</li>
					<li class="mr-6 my-2 md:my-0">
							<a href="{{route('schedule.day')}}" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline 
							hover:text-gray-100 border-b-2 border-gray-900
							 hover:border-red-400">
								<i class="fa fa-wallet fa-fw mr-3"></i>
								<span class="pb-1 md:pb-0 text-sm">جدول اليوم</span>
							</a>
					</li>
					<li class="mr-6 my-2 md:my-0">
						<a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline 
						hover:text-gray-100 border-b-2 border-gray-900
						 hover:border-red-400">
							<i class="fa fa-wallet fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">الواجبات</span>
						</a>
				</li>
					@endif

					{{-- tracher --}}
					@if (auth()->user()->IsٍTeacher())
					<li class="mr-6 my-2 md:my-0">
						<a href="{{route('teachersubject')}}" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline 
						hover:text-gray-100 border-b-2 border-gray-900
						 hover:border-red-400">
							<i class="fa fa-wallet fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">المواد الدراسية</span>
						</a>
					</li>
					<li class="mr-6 my-2 md:my-0">
						<a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline 
						hover:text-gray-100 border-b-2 border-gray-900
						 hover:border-red-400">
							<i class="fa fa-wallet fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">رسئل الادارة</span>
						</a>
					</li>
					<li class="mr-6 my-2 md:my-0">
						<a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline 
						hover:text-gray-100 border-b-2 border-gray-900
						 hover:border-red-400">
							<i class="fa fa-wallet fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">رسئل ولئ الأمر</span>
						</a>
					</li>
					@endif
                   
				</ul>
				
				<div class="relative pull-right pl-4 pr-4 md:pr-0">
                    <input type="search" placeholder="Search" class="w-full bg-gray-900 text-sm text-gray-400 transition border border-gray-800 focus:outline-none focus:border-gray-600 rounded py-1 px-2 pl-10 appearance-none leading-normal">
                    <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">
                        <svg class="fill-current pointer-events-none text-gray-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </div>
                </div>
				
			</div>
			
		</div>
	</nav>
	@if(session()->has('error'))
 
	<div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
		<div class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
		  <span class="text-red-500">
			<svg fill="currentColor"
			   viewBox="0 0 20 20"
			   class="h-6 w-6">
			  <path fill-rule="evenodd"
				  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
				  clip-rule="evenodd"></path>
			</svg>
		  </span>
		</div>
	  <div class="alert-content ml-4">
		  <div class="alert-title font-semibold text-lg text-red-800">
			  خطأ
		  </div>
		  <div class="alert-description text-sm text-red-600">
			  {{session()->get('error')}}
		  </div>
		</div>
	  </div>
	@endif
{{-- success --}}
@if(session()->has('success'))
<div class="alert flex flex-row items-center bg-green-200 p-5 rounded border-b-2 border-green-300">
	<div class="alert-icon flex items-center bg-green-100 border-2 border-green-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
	  <span class="text-green-500">
		<svg fill="currentColor"
		   viewBox="0 0 20 20"
		   class="h-6 w-6">
		  <path fill-rule="evenodd"
			  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
			  clip-rule="evenodd"></path>
		</svg>
	  </span>
	</div>
	<div class="alert-content ml-4">
	  <div class="alert-title font-semibold text-lg text-green-800">
		نجاح
	  </div>
	  <div class="alert-description text-sm text-green-600">
		  {{session()->get('success')}}
	  </div>
	</div>
  </div>
  @endif
	{{-- end message --}}
@yield('content')

{{-- <script type="text/javascript">
	
	
	/*Toggle dropdown list*/
	/*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

	var userMenuDiv = document.getElementById("userMenu");
	var userMenu = document.getElementById("userButton");
	
	var navMenuDiv = document.getElementById("nav-content");
	var navMenu = document.getElementById("nav-toggle");
	
	document.onclick = check;

	function check(e){
	  var target = (e && e.target) || (event && event.srcElement);

	  //User Menu
	  if (!checkParent(target, userMenuDiv)) {
		// click NOT on the menu
		if (checkParent(target, userMenu)) {
		  // click on the link
		  if (userMenuDiv.classList.contains("invisible")) {
			userMenuDiv.classList.remove("invisible");
		  } else {userMenuDiv.classList.add("invisible");}
		} else {
		  // click both outside link and outside menu, hide menu
		  userMenuDiv.classList.add("invisible");
		}
	  }
	  
	  //Nav Menu
	  if (!checkParent(target, navMenuDiv)) {
		// click NOT on the menu
		if (checkParent(target, navMenu)) {
		  // click on the link
		  if (navMenuDiv.classList.contains("hidden")) {
			navMenuDiv.classList.remove("hidden");
		  } else {navMenuDiv.classList.add("hidden");}
		} else {
		  // click both outside link and outside menu, hide menu
		  navMenuDiv.classList.add("hidden");
		}
	  }
	  
	}

	function checkParent(t, elm) {
	  while(t.parentNode) {
		if( t == elm ) {return true;}
		t = t.parentNode;
	  }
	  return false;
	}


</script> --}}

</body>
</html>