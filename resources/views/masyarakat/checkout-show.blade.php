<x-app-layout>
    <x-slot name="title">
      Checkout Item - {{ $item->name }}
    </x-slot> 
    <x-slot name="style">
      <style>
          /* The Modal (background) */
          .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
          }

          /* Modal Content (Image) */
          .modal-content {
          margin: auto;
          display: block;
          width: 80%;
          max-width: 700px;
          }

          /* Add Animation - Zoom in the Modal */
          .modal-content, #caption {
          animation-name: zoom;
          animation-duration: 0.6s;
          }

          @keyframes zoom {
          from {transform:scale(0)}
          to {transform:scale(1)}
          }

          /* The Close Button */
          .close {
          position: absolute;
          top: 15px;
          right: 35px;
          color: #f1f1f1;
          font-size: 40px;
          font-weight: bold;
          transition: 0.3s;
          }

          .close:hover,
          .close:focus {
          color: #bbb;
          text-decoration: none;
          cursor: pointer;
          }

          /* 100% Image Width on Smaller Screens */
          @media only screen and (max-width: 700px){
          .modal-content {
              width: 100%;
          }
          }
      </style>
  </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-lg leading-6 font-medium text-gray-900 uppercase font-semibold mb-5">Track barang</h1>
                    <div class="relative w-1/2 m-8">
                        <div class="border-r-2 border-red-300 absolute h-full top-0" style="left: 15px"></div>
                        <ul class="list-none m-0 p-0">
                        <li class="mb-10">
                            <div class="flex items-center mb-1">
                              <div class="bg-red-300 rounded-full h-8 w-8"></div>
                              <div class="flex-1 ml-4 font-medium">{{ $checkout->created_at->format('d F Y | ') }} {{ $checkout->created_at->format(' H:i:s') }} - <i class="fas fa-shopping-cart text-green-400"></i> <span class="text-xs text-gray-400">{{ $checkout->people->name }} melakukan checkout</span></div>
                            </div>
                            <div class="ml-12">
                              <!-- Trigger the Modal -->
                              <img id="myImg{{ $checkout->id }}" src="{{ $checkout->getMedia('checkout')[0]->getUrl() }}" onclick="modal('myImg{{ $checkout->id }}')" alt="Activity" class="rounded-sm cursor-pointer transition-all hover:opacity-70 mb-5 h-1/4 w-1/4">
                          </div>
                        </li> 
                        @if ($checkout->receipt_at !== null)
                        <li class="mb-10">
                          <div class="flex items-center mb-1">
                            <div class="bg-red-300 rounded-full h-8 w-8"></div>
                            <div class="flex-1 ml-4 font-medium">{{ $checkout->receipt_at->format('d F Y | ') }} {{ $checkout->receipt_at->format(' H:i:s') }} - <i class="fas fa-truck text-blue-400"></i> <span class="text-xs text-gray-400">{{ $checkout->operator->name }} menginput resi ({{ $checkout->courier }} - {{ $checkout->receipt }})</span></div>
                          </div>
                        </li> 
                        @endif
                        @if ($checkout->done_at !== null)
                        <li class="mb-10">
                          <div class="flex items-center mb-1">
                            <div class="bg-red-300 rounded-full h-8 w-8"></div>
                            <div class="flex-1 ml-4 font-medium">{{ $checkout->done_at->format('d F Y | ') }} {{ $checkout->done_at->format(' H:i:s') }} - <i class="fas fa-box-open text-red-400"></i> <span class="text-xs text-gray-400">Paket telah sampai di {{ Str::limit($checkout->address, 10)  }}</span></div>
                          </div>
                        </li> 
                        @endif
                      </ul>
                    </div>
                    @if ($checkout->done_at === null && $checkout->receipt_at !== null)
                    <div class="text-right">
                        <form id="{{ $checkout->id }}" action="{{ route('checkout.done', ['auction' => $auction->id, 'item' => $item->id]) }}" method="POST">
                            @csrf
                            @method('patch')
                          </form>
                        <a onclick="doneConfirm('{{ $checkout->id }}')" class="bg-green-300 opacity-75 hover:opacity-100 text-green-900 hover:text-gray-900 rounded-full px-10 py-2 font-semibold" href="#"><i class="fas fa-check -ml-2 mr-2"></i>SAMPAI</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

     <!-- The Modal -->
     <div id="myModal" class="modal">

      <!-- The Close Button -->
      <span class="close" onclick="closeModal()">&times;</span>

      <!-- Modal Content (The Image) -->
      <img class="modal-content" id="img01">
    </div>

    <x-slot name="script">
      @if (session('success'))
      <script>
          document.addEventListener('DOMContentLoaded', function() { 
              success('Transaksi selesai!')
          }, true); 
      </script>
      @endif
      <script>

          let modal = function(imgId) {
              let modal = document.getElementById('myModal');
              let img = document.getElementById(imgId);
              let modalImg = document.getElementById('img01');

              modal.style.display = "block";
              modalImg.src = img.src;
              captionText.innerHTML = img.alt;
          }

         let closeModal = function() {
              let modal = document.getElementById('myModal');
              modal.style.display = "none";
          }
          
      </script>
  </x-slot>
</x-app-layout>