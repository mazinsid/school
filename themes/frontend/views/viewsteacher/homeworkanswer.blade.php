@extends('layouts.header')

@section('content')

  <main class=" sm:mt-40">
    <!--Container-->
    {{-- alert message --}}
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
<!--Container-->
<div class="container w-full mx-auto pt-20">
		
		<div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
			
			<!--Console Content-->
			
		
			<!--Divider-->
			<hr class="border-b-2 border-gray-600 my-8 mx-4">

            <div class="flex flex-row flex-wrap flex-grow mt-2">


     

                <div class="w-full p-3">
                    <!--Table Card-->
                    <div class="bg-gray-900 border border-gray-800 rounded shadow">
                        <div class="border-b border-gray-800 p-3">
                            <h5 class="font-bold uppercase text-gray-600"></h5>
                         </div>
                        <div class="p-5">
                            <table class="w-full p-5 text-gray-700">
                                <thead>
                                    <tr>
                                        <th class="text-right text-gray-600">الطالب</th>
                                        <th class="text-right text-gray-600">حل الواجب</th>
                                       
                                    </tr>
                                </thead>

                                <tbody>   
                                    @foreach($answers as $answer)
                                    <tr>
                                        <td>
                                            {{$answer->student->full_name}}
                                         
                                        </td>
                            
                                        <td>
                                            <a href="{{$answer->answers}}">حل الواجب</a>
                                            
                                        </td>
                                       
                                    </tr> 
                                    @endforeach                                 
                                </tbody>
                            </table>

                
                        </div>
                    </div>
                    
                    <!--/table Card-->
                    
                </div>


            </div>
								
			<!--/ Console Content-->
					
		</div>
		

	</div> 
	<!--/container-->
</main>
@endsection
