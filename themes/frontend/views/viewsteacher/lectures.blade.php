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
                            <h5 class="font-bold uppercase text-gray-600">{{$subject->name}}</h5>
                         </div>
                        <div class="p-5">
                            <table class="w-full p-5 text-gray-700">
                                <thead>
                                    <tr>
                        
                                        <th class="text-right text-gray-600">رقم الحصة</th>
                                        <th class="text-right text-gray-600">المحتوي</th>
                                        <th class="text-right text-gray-600">الواجب</th>
                                        <th class="text-right text-gray-600">تصحيح الواجب</th>
                                    </tr>
                                </thead>

                                <tbody>   
                                    @foreach($lectures as $lecture)
                                    <tr>
                                       <td>
                                            <a>{{$lecture->number}}</a>
                                        </td>
                                         <td>
                                            <a href="{{route('teacher.lectures',$lecture->id)}}"> المحتوي</a>
                                        </td>
                                      <td>
                                        <a href="#" onclick="document.getElementById('myModal{{$lecture->id}}').showModal()" id="btn" class="py-2  bg-gray-800 text-white rounded text shadow-xl">الواجب</a>
                                        </td>
                                        <td>
                                          <a href="{{route('homeworek_answer_index',$lecture->id)}}" >الواجب</a>
                                          </td>
                                    </tr> 
                                    @endforeach                                 
                                </tbody>
                            </table>

                
                        </div>
                    </div>
                    
                    <!--/table Card-->
                    @foreach($lectures as $lecture)
                    <dialog id="myModal{{$lecture->id}}" class="h-auto w-11/12 md:w-1/2 p-5  bg-white rounded-md ">
        
                      <div class="flex flex-col w-full h-auto ">
                           <!-- Header -->
                           <div class="flex w-full h-auto justify-center items-center">
                             <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                              {{$lecture->subject->name}} : {{$lecture->number}}
                             </div>
                             <div onclick="document.getElementById('myModal{{$lecture->id}}').close();" class="flex w-1/12 h-auto justify-center cursor-pointer">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                             </div>
                             <!--Header End-->
                           </div>
                             <!-- Modal Content-->
                              <div class="flex w-full h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-center text-gray-500">
                                      <div class="m-7">
                                        <form action="{{route('homework_store')}}" method="POST">
                                          @csrf
                                              {{-- @method('PUT') --}}
                  
                                              <div class="mb-6">
                                                  <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">الواجب</label>
                                                  <input  type="hidden" name="subject_id" value="{{$lecture->subject_id}}" >
                                                  <input  type="hidden" name="lectuer_id" value="{{$lecture->id}}" >
                                                  <input  type="text" name="linkwork" id="name" placeholder="https://docs.google.com/forms/u/0/" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                                              </div>
                                              
                                              
                                              <div class="mb-6">
                                                  <button type="submit" class=" btn-submit w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">أضافة واجب</button>
                                              </div>
                                              <p class="text-base text-center text-gray-400" id="result">
                                              </p>
                                        </form>
                                      </div>
                             </div>
                             <!-- End of Modal Content-->
                             
                             
                             
                           </div>
                   </dialog>
                   @endforeach    
                  {{-- end modal --}}
                </div>


            </div>
								
			<!--/ Console Content-->
					
		</div>
		

	</div> 
	<!--/container-->
</main>
@endsection
