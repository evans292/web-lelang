<x-operator-layout>
    <x-slot name="title">
      {{ __('Dashboard Operator') }}
    </x-slot>  
  
    <div class="relative">
        <div class="px-4 md:px-10 mx-auto w-full">
          <div>
            <!-- Card stats -->
            <div class="flex flex-wrap">
              <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg pb-6"
                >
                  <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                      <div
                        class="relative w-full pr-4 max-w-full flex-grow flex-1"
                      >
                        <h5 class="text-gray-500 uppercase font-bold text-xs mb-2">
                          Jumlah Petugas
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                          {{ $count_op }}
                        </span>
                      </div>
                      <div class="relative w-auto pl-4 flex-initial">
                        <div
                          class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-indigo-500"
                        >
                          <i class="fas fa-user-shield"></i>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg pb-6"
                >
                  <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                      <div
                        class="relative w-full pr-4 max-w-full flex-grow flex-1"
                      >
                        <h5 class="text-gray-500 uppercase font-bold text-xs mb-2">
                          Jumlah Barang
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                          {{ $count_it }}
                        </span>
                      </div>
                      <div class="relative w-auto pl-4 flex-initial">
                        <div
                          class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-green-500"
                        >
                          <i class="fas fa-cubes"></i>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg pb-6"
                >
                  <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                      <div
                        class="relative w-full pr-4 max-w-full flex-grow flex-1"
                      >
                        <h5 class="text-gray-500 uppercase font-bold text-xs mb-2">
                          Jumlah Lelang
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                          {{ $count_it }}
                        </span>
                      </div>
                      <div class="relative w-auto pl-4 flex-initial">
                        <div
                          class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"
                        >
                          <i class="fas fa-gavel"></i>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg pb-6"
                >
                  <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                      <div
                        class="relative w-full pr-4 max-w-full flex-grow flex-1"
                      >
                        <h5 class="text-gray-500 uppercase font-bold text-xs mb-2">
                          Jumlah Penawar
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                          {{ $count_it }}
                        </span>
                      </div>
                      <div class="relative w-auto pl-4 flex-initial">
                        <div
                          class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-yellow-500"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
    <x-slot name="script">
      @if (session('admin'))
          <script>
              document.addEventListener('DOMContentLoaded', function() { 
                  greet('Admin', 'bottom-right')
              }, true); 
          </script>
       @elseif (session('operator'))
       <script>
           document.addEventListener('DOMContentLoaded', function() { 
               greet('Operator', 'bottom-right')
           }, true); 
       </script>
       @endif
  </x-slot>
  </x-operator-layout>