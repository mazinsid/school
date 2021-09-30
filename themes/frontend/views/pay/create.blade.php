@extends('layouts.header')

@section('content')
<main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-40">
<!-- Code on GiHub: https://github.com/vitalikda/form-floating-labels-tailwindcss -->
<style>
  .-z-1 {
    z-index: -1;
  }

  .origin-0 {
    transform-origin: 0%;
  }

  input:focus ~ label,
  input:not(:placeholder-shown) ~ label,
  textarea:focus ~ label,
  textarea:not(:placeholder-shown) ~ label,
  select:focus ~ label,
  select:not([value='']):valid ~ label {
    /* @apply transform; scale-75; -translate-y-6; */
    --tw-translate-x: 0;
    --tw-translate-y: 0;
    --tw-rotate: 0;
    --tw-skew-x: 0;
    --tw-skew-y: 0;
    transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate))
      skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    --tw-scale-x: 0.75;
    --tw-scale-y: 0.75;
    --tw-translate-y: -1.5rem;
  }

  input:focus ~ label,
  select:focus ~ label {
    /* @apply text-black; left-0; */
    --tw-text-opacity: 1;
    color: rgba(0, 0, 0, var(--tw-text-opacity));
    left: 0px;
  }
</style>

<div class="min-h-screen bg-gray-100 p-0 sm:p-12">
  <div class="mx-auto max-w-md px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
      @foreach ( $students as $student)
          

    <h1 class="text-2xl font-bold mb-8">{{$student->full_name }}</h1>
    <form class="form" id="form" action="{{route('pay.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
     
    

      <div class="relative z-0 w-full mb-5">
        <select
        name="type_pay"
        value=""
        onclick="this.setAttribute('value', this.value);"
        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200"
      >
        <option value="" selected disabled hidden></option>
        <option value="كاش">كاش</option>
        <option value="بنك">بنك</option>
      </select>
      <label for="select" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">طريقة الدفع</label>
      <span class="text-sm text-red-600 hidden" id="error">طريقة الدفع</span>
    </div>

        <div class="relative z-0 w-full mb-5">
        <select
          name="installment"
          value=""
          onclick="this.setAttribute('value', this.value);"
          class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200"
        >
          <option value="" selected disabled hidden></option>
          <option value="القسط الاول">القسط الاول</option>
          <option value="القسط الثاني">القسط الثاني</option>
        </select>
        <label for="select" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">الاقساط</label>
        <span class="text-sm text-red-600 hidden" id="error">الاقساط</span>
      </div>



      <div>
        <label class="block text-sm font-medium text-gray-700">
          المبلق بالجنيه  
        </label>
       
      <div class="relative z-0 w-full mb-5"> 
                <input  name="amount" type="number" class="form_control">
            </div>
      
          </div>   

     <div>
          <label class="block text-sm font-medium text-gray-700">
            صورة أشعار التحويل
          </label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                  
                  <input id="file-upload"  name="notice_tranfer" type="file">
                </label>
           
              </div>
              <p class="text-xs text-gray-500">
                PNG, JPG, GIF up to 10MB
              </p>
            </div>
          </div>
        </div>
      </div>
      </div>


      <input
        type="hidden"
        name="student_id"
    value="{{$student->id }}"
    >
      {{-- <div class="relative z-0 w-full mb-5">
        <input
          type="number"
          name="money"
          placeholder=" "
          class="pt-3 pb-2 pl-5 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
        />
        <div class="absolute top-0 left-0 mt-3 ml-1 text-gray-400">$</div>
        <label for="money" class="absolute duration-300 top-3 left-5 -z-1 origin-0 text-gray-500">Amount</label>
        <span class="text-sm text-red-600 hidden" id="error">Amount is required</span>
      </div>

      <div class="relative z-0 w-full mb-5">
        <input
          type="text"
          name="duration"
          placeholder=" "
          class="pt-3 pb-2 pr-12 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
        />
        <div class="absolute top-0 right-0 mt-3 mr-4 text-gray-400">min</div>
        <label for="duration" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Duration</label>
        <span class="text-sm text-red-600 hidden" id="error">Duration is required</span>
      </div> --}}

      <button
        id="button"
        type="submit"
        class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none"
      >
        تسجيل طالب
      </button>
    </form>
  </div>
</div>
@endforeach
<script>
  'use strict'

  document.getElementById('button').addEventListener('click', toggleError)
  const errMessages = document.querySelectorAll('#error')

  function toggleError() {
    // Show error message
    errMessages.forEach((el) => {
      el.classList.toggle('hidden')
    })

    // Highlight input and label with red
    const allBorders = document.querySelectorAll('.border-gray-200')
    const allTexts = document.querySelectorAll('.text-gray-500')
    allBorders.forEach((el) => {
      el.classList.toggle('border-red-600')
    })
    allTexts.forEach((el) => {
      el.classList.toggle('text-red-600')
    })
  }
</script>
<script>
  'use strict'

  document.getElementById('button').addEventListener('click', toggleError)
  const errMessages = document.querySelectorAll('#error')

  function toggleError() {
    // Show error message
    errMessages.forEach((el) => {
      el.classList.toggle('hidden')
    })

    // Highlight input and label with red
    const allBorders = document.querySelectorAll('.border-gray-200')
    const allTexts = document.querySelectorAll('.text-gray-500')
    allBorders.forEach((el) => {
      el.classList.toggle('border-red-600')
    })
    allTexts.forEach((el) => {
      el.classList.toggle('text-red-600')
    })
  }
</script>
</main>
@endsection
