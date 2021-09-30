@extends('layouts.header')

@section('content')

  <main class=" sm:mt-40">
    <!--Container-->
    {{-- end message --}}
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full table-auto">
        <thead class="justify-between">
          <tr class="bg-gray-800">
              <th class="px-16 py-2"></th>
              <th class="px-16 py-2">
                  الاسم
                  </th>
                  <th class="px-16 py-2">
                      القصد
                  </th>
                  <th class="px-16 py-2">
                    المبلغ
                </th>
                  <th class="px-16 py-2">
                      <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($payInfos as $payInfo)
                <tbody class="bg-gray-200">
                    <tr class="bg-white border-4 border-gray-200">
                      <td class="px-16 py-2 flex flex-row items-center">
                        <img
                          class="h-8 w-8 rounded-full object-cover "
                          src="{{asset('storage/'.$payInfo->student->image)}}"
                          alt=""
                        />
                      </td>
                      <td class="px-16 py-2">
              
                          {{ $payInfo->student->full_name }}
                      </td>
                        <td class="px-16 py-2">
                            {{ $payInfo->student->email }}
                   
                  </td>
              
            
                  <td class="px-16 py-2">
                      {{$payInfo->installment}}
                  </td>
                  <td class="px-16 py-2">
                    {{$payInfo->amount}}
                </td>
               
                </tr>
                @endforeach
                <!-- More people... -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<!--/container-->
</main>
@endsection
