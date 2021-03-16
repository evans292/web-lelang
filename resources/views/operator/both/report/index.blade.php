<x-operator-layout>
    <x-slot name="title">
      {{ __('Laporan Lelang') }}
    </x-slot>  

    <div class="px-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                  <form action="{{ route('operator.report') }}" method="GET">
                      @csrf
                      <div class="flex justify-around">
                        <div class="mb-4 w-full mr-4">
                            <x-label for="tgl1" :value="__('Dari Tanggal*')" />
                            <x-input id="tgl1" class="block mt-1 w-full" type="date" name="tgl1" value="" required />
                            <x-validation-message name="tgl1"/>
                        </div>
                        <div class="mb-4 w-full">
                            <x-label for="tgl2" :value="__('Sampai Tanggal*')" />
                            <x-input id="tgl2" class="block mt-1 w-full" type="date" name="tgl2" value="" required />
                            <x-validation-message name="tgl2"/>
                        </div>
                      </div>

                      <div class="flex items-center justify-end mt-4">            
                        <x-button class="ml-3">
                            {{ __('Cari') }}
                        </x-button>
                    </div>
                  </form> 

                  
              </div>
          </div>
      </div>
    </div>

    @if ($request->request->count() !== 0)
    <div class="px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
              <div class="p-6">
              <div class="flex flex-col">
                  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="mb-3">
                        <a href="{{ route('operator.report.excel', ['tgl1' => $request->tgl1, 'tgl2' => $request->tgl2]) }}" class="inline-flex items-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-file-excel mr-2"></i></i>Export Excel</a>
                        <a href="{{ route('operator.report.pdf', ['tgl1' => $request->tgl1, 'tgl2' => $request->tgl2]) }}" class="inline-flex items-center px-4 py-2 bg-red-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-file-pdf mr-2"></i></i>Export PDF</a>
                    </div>
                      <div class="shadow overflow-hidden sm:rounded-lg">
                      <table class="min-w-full divide-y divide-gray-200">
                          <thead class="bg-gray-50">
                          <tr>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  #
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Nama
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Harga Awal
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Harga Akhir
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Pemenang
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Penginput
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Lelang
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                  Status
                              </th>
                          </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-gray-200">
                          @foreach ($datas as $data)
                          <tr>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                  {{ $loop->iteration }}
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                  {{ Str::limit($data->item->name, 10) }}
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                  @currency($data->item->starting_price)
                              </span>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                  @currency($data->final_price)
                              </span>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                  @if ($data->bid !== null)
                                      {{ Str::limit($data->bid->people->name, 10) }}
                                  @else
                                      Belum ada
                                  @endif
                              </td>   
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ Str::limit($data->operator->name, 10)}}  
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $data->auction_date->format('Y-m-d') }}  
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-left">
                                  @if ($data->status === 'close')
                                    <span class="text-red-500 font-bold">Ditutup</span>  
                                  @else
                                  <span class="text-green-500 font-bold">Dibuka</span>  
                                  @endif
                              </td>   
                          </tr>
                          @endforeach            
                          <!-- More items... -->
                          </tbody>
                      </table>
                      </div>
                  </div>
                  </div>
              </div>
                </div>
            </div>
        </div>
      </div>
      @endif
  </x-operator-layout>