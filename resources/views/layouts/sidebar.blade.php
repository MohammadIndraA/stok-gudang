 <ul class="navbar-nav">
     <li
         class="uppercase text-[11px]  text-black dark:text-primary-400 mt-0 leading-4 mb-2 group-data-[sidebar=dark]:text-primary-400 group-data-[sidebar=brand]:text-primary-300">
         <span
             class="text-[9px] text-black dark:text-slate-500 group-data-[sidebar=dark]:text-slate-500 group-data-[sidebar=brand]:text-slate-600">Dashboard
             & Apps</span>
     </li>
     <li>
         {{-- Dahsboard --}}
         <a href="/dashboard"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="gauge"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Dahsboard</span>
         </a>

         {{-- Vendor --}}
         <a href="{{ route('admin.vendor.index') }}"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="image-plus"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Vendor</span>
         </a>

         {{-- Aplikator --}}
         <a href="{{ route('admin.aplikator.index') }}"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="book-open-check"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Aplikator</span>
         </a>

         {{-- Material --}}
         <a href="{{ route('admin.material.index') }}"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="ice-cream-2"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Material</span>
         </a>

         {{-- Purchase Order  --}}
         <a href="{{ route('admin.purchase-order.index') }}"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="building-2"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Purchase Order </span>
         </a>


         {{-- Bukti Penerimaan Barang  --}}
         <a href="{{ route('admin.penerimaan-material.index') }}"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="ice-cream-2"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Bukti Penerimaan Barang</span>
         </a>


         {{-- Permintaan Material  --}}
         <a href=""
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="ice-cream-2"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Permintaan Material</span>
         </a>

         {{-- Stok --}}
         <a href="#"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-type="collapse" data-fc-parent="parent-accordion">
             <span data-lucide="lock"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Stok</span>
             <i
                 class="icofont-thin-down  fc-collapse-open:rotate-180 ms-auto inline-block text-[14px] transform transition-transform duration-300 text-black dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></i>
         </a>
         <div id="Authentication-flush" class="hidden  overflow-hidden" aria-labelledby="Authentication">
             <ul class="nav flex-col flex flex-wrap ps-0 mb-0 ms-2">
                 <li class="nav-item relative block">
                     <a href="{{ route('admin.masuk.index') }}"
                         class="nav-link text-slate-600 dark:text-slate-300 hover:text-black rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-black   flex items-center decoration-0 px-3 py-3">
                         <i
                             class="icofont-dotted-right me-2 text-black text-[8px] group-data-[sidebar=brand]:text-slate-600"></i>
                         Stok Masuk
                     </a>
                 </li>
                 <li class="nav-item relative block">
                     <a href="{{ route('admin.keluar.index') }}"
                         class="nav-link text-slate-600 dark:text-slate-300 hover:text-black rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-black   flex items-center decoration-0 px-3 py-3">
                         <i
                             class="icofont-dotted-right me-2 text-black text-[8px] group-data-[sidebar=brand]:text-slate-600"></i>
                         Stok Keluar
                     </a>
                 </li>
             </ul>
         </div>

         {{-- Perumahan --}}
         <a href="#"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-type="collapse" data-fc-parent="parent-accordion">
             <span data-lucide="home"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Perumahan</span>
             <i
                 class="icofont-thin-down  fc-collapse-open:rotate-180 ms-auto inline-block text-[14px] transform transition-transform duration-300 text-black dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></i>
         </a>
         <div id="Authentication-flush" class="hidden  overflow-hidden" aria-labelledby="Authentication">
             <ul class="nav flex-col flex flex-wrap ps-0 mb-0 ms-2">
                 <li class="nav-item relative block">
                     <a href="{{ route('admin.project.index') }}"
                         class="nav-link text-slate-600 dark:text-slate-300 hover:text-black rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-black   flex items-center decoration-0 px-3 py-3">
                         <i
                             class="icofont-dotted-right me-2 text-black text-[8px] group-data-[sidebar=brand]:text-slate-600"></i>
                         Perumahan
                     </a>
                 </li>
                 <li class="nav-item relative block">
                     <a href="{{ route('admin.blok.index') }}"
                         class="nav-link text-slate-600 dark:text-slate-300 hover:text-black rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-black   flex items-center decoration-0 px-3 py-3">
                         <i
                             class="icofont-dotted-right me-2 text-black text-[8px] group-data-[sidebar=brand]:text-slate-600"></i>
                         Blok
                     </a>
                 </li>
                 <li class="nav-item relative block">
                     <a href="{{ route('admin.kapling.index') }}"
                         class="nav-link text-slate-600 dark:text-slate-300 hover:text-black rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-black   flex items-center decoration-0 px-3 py-3">
                         <i
                             class="icofont-dotted-right me-2 text-black text-[8px] group-data-[sidebar=brand]:text-slate-600"></i>
                         Kapling
                     </a>
                 </li>
             </ul>
         </div>



         {{-- Tahapan Pengerjaan  --}}
         <a href=""
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="ice-cream-2"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Tahapan Pengerjaan</span>
         </a>

         {{-- setting --}}
         <a href="#"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-type="collapse" data-fc-parent="parent-accordion">
             <span data-lucide="lock"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Settings</span>
             <i
                 class="icofont-thin-down  fc-collapse-open:rotate-180 ms-auto inline-block text-[14px] transform transition-transform duration-300 text-black dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></i>
         </a>
         <div id="Authentication-flush" class="hidden  overflow-hidden" aria-labelledby="Authentication">
             <ul class="nav flex-col flex flex-wrap ps-0 mb-0 ms-2">
                 <li class="nav-item relative block">
                     <a href="{{ route('admin.role.index') }}"
                         class="nav-link text-slate-600 dark:text-slate-300 hover:text-black rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-black   flex items-center decoration-0 px-3 py-3">
                         <i
                             class="icofont-dotted-right me-2 text-black text-[8px] group-data-[sidebar=brand]:text-slate-600"></i>
                         Role
                     </a>
                     <a href="{{ route('admin.user.index') }}"
                         class="nav-link text-slate-600 dark:text-slate-300 hover:text-black rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-black   flex items-center decoration-0 px-3 py-3">
                         <i
                             class="icofont-dotted-right me-2 text-black text-[8px] group-data-[sidebar=brand]:text-slate-600"></i>
                         User
                     </a>
                 </li>
             </ul>
         </div>

         {{-- logout --}}
         <hr class="mt-5">
         <form action="{{ route('logout') }}" method="post">
             @csrf
             <button type="submit"
                 class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
                 data-fc-parent="parent-accordion">
                 <span data-lucide="log-out"
                     class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
                 <span class="text-black dark:text-slate-300">Sign Out</span>
             </button>
         </form>
     </li>
 </ul>
