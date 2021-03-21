<x-app-layout>
    <x-slot name="title">
        Profil - {{ $data->name }}
    </x-slot>
    <x-slot name="nav">
        @include('layouts.navigation')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Saya') }}
        </h2>
    </x-slot>

    <main class="profile-page mt-80">
        <section class="relative block h-500-px">
          <div
            class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
            style="transform: translateZ(0px);"
          >
            <svg
              class="absolute bottom-0 overflow-hidden"
              xmlns="http://www.w3.org/2000/svg"
              preserveAspectRatio="none"
              version="1.1"
              viewBox="0 0 2560 100"
              x="0"
              y="0"
            >
              <polygon
                class="text-gray-300 fill-current"
                points="2560 0 2560 100 0 100"
              ></polygon>
            </svg>
          </div>
        </section>
        <section class="relative py-16 bg-gradient-to-r from-red-400 to-blue-500">
          <div class="container mx-auto px-4">
            <div
              class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64"
            >
              <div class="px-6">
                <div class="flex flex-wrap justify-center">
                  <div
                    class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center"
                  >
                    <div class="">
                    @if (Auth::user()->getMedia('avatar')->count() === 0)
                      <img
                        alt="..."
                        src="{{ asset('image/download.png') }}"
                        class="shadow-xl rounded-full max-h-150-px align-middle border-none absolute -m-16 -ml-20 lg:-ml-28 max-w-150-px"
                      />
                    @else
                        <img
                        alt="..."
                        src="{{ Auth::user()->getMedia('avatar')[0]->getUrl() }}"
                        class="shadow-xl rounded-full max-h-150-px align-middle border-none absolute -m-16 -ml-20 lg:-ml-24 max-w-150-px"
                    />
                    @endif
                    </div>
                  </div>
                </div>
                <div class="text-center mt-40">
                  <h3
                    class="text-4xl font-semibold leading-normal mb-2 text-gray-800 mb-2"
                  >
                    {{ $data->name }} 
                    <a href="{{ route('profile.edit') }}"><i class="fas fa-pencil-alt text-yellow-400 mr-1 text-sm"></i></a>
                  </h3>
                  @if ($data->address !== null )
                  <div
                    class="text-sm leading-normal mt-0 mb-2 text-gray-500 font-bold uppercase"
                  >
                    <i
                      class="fas fa-map-marker-alt mr-2 text-lg text-gray-500"
                    ></i>
                    {{ $data->address }}
                  </div>
                  @endif
                  @if ($data->birthdate !== null )
                  <div class="mb-2 text-gray-700 mt-10">
                    <i class="fas fa-birthday-cake mr-2 text-lg text-gray-500"></i
                    >{{ $data->birthdate->format('d M Y') }}
                  </div>
                  @endif
                  @if ($data->birthdate !== null )
                  <div class="mb-2 text-gray-700">
                    <i class="fas fa-phone-alt mr-2 text-lg text-gray-500"></i
                    >{{ $data->phone }}
                  </div>
                  @endif
                </div>
                @if (Auth::user()->role_id == 3)
                <div class="mt-10 py-10 border-t border-gray-300 text-center">
                    <div class="flex flex-wrap justify-center">
                      <div class="w-full lg:w-4/12 px-4 lg:order-1">
                          <div class="flex justify-center py-4 lg:pt-4 pt-8">
                            <div class="mr-4 p-3 text-center">
                              <span
                                class="text-xl font-bold block uppercase tracking-wide text-gray-700"
                                >{{ $bidCount }}x</span
                              ><span class="text-sm text-gray-500">Ikut Lelang</span>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                @else
                <div class="mt-10 py-10 border-t border-gray-300 text-center">
                    <div class="flex flex-wrap justify-center">
                      <div class="w-full lg:w-4/12 px-4 lg:order-1">
                          <div class="flex justify-center py-4 lg:pt-4 pt-8">
                            <div class="mr-4 p-3 text-center">
                              <span class="text-sm text-gray-500 hidden">Halo operator :)</span>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </section>
      </main>

      <x-slot name="script">
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                success('Profile diperbarui!')
            }, true); 
        </script>
        @endif
    </x-slot>
</x-app-layout>