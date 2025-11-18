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

         {{-- Banner --}}
         <a href="{{ route('admin.banner.index') }}"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="image-plus"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Banner</span>
         </a>

         {{-- Pelayanan Publik --}}
         <a href="{{ route('admin.pelayanan-publik.index') }}"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="book-open-check"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Pelayanan Publik</span>
         </a>

         {{-- Sub Pelayanan Publik --}}
         <a href="{{ route('admin.sub-pelayanan-publik.index') }}"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="ice-cream-2"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Sub Pelayanan Publik</span>
         </a>

         {{-- Menu Profil --}}
         <a href="{{ route('admin.profil.index') }}"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="building-2"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Menu Profil</span>
         </a>


         {{-- Berita --}}
         <a href="#"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200 flex items-center decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black "
             data-fc-type="collapse" data-fc-parent="parent-accordion">
             <span data-lucide="network"
                 class="w-5 h-5 text-center text-slate-600 dark:text-slate-400 me-2 group-data-[sidebar=dark]:text-black group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">Berita</span>
             <i
                 class="icofont-thin-down ms-auto inline-block text-[14px] transform transition-transform duration-300 text-black dark:text-slate-400 group-data-[sidebar=dark]:text-black group-data-[sidebar=brand]:text-black fc-collapse-open:rotate-180 "></i>
         </a>

         {{-- Berita --}}
         <div id="holding-flush" class="hidden  overflow-hidden">
             <ul class="nav flex-col flex flex-wrap ps-0 mb-0 ms-2">
                 <li class="nav-item relative block">
                     <a href="{{ route('admin.post.index') }}"
                         class="nav-link text-slate-600 dark:text-slate-300 hover:text-black rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-600">
                         <i
                             class="icofont-dotted-right me-2 text-black text-[8px] group-data-[sidebar=brand]:text-slate-600 "></i>
                         Post
                     </a>
                 </li>
                 <li class="nav-item relative block">
                     <a href="{{ route('admin.categories.index') }}"
                         class="nav-link text-slate-600 dark:text-slate-300 hover:text-black rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-600">
                         <i
                             class="icofont-dotted-right me-2 text-black text-[8px] group-data-[sidebar=brand]:text-slate-600 "></i>
                         Kategori
                     </a>
                 </li>
             </ul>
         </div>

         {{-- user --}}
         <a href="{{ route('admin.update-profil.index') }}"
             class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-black"
             data-fc-parent="parent-accordion">
             <span data-lucide="users"
                 class="w-5 h-5 text-center text-slate-600 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-600"></span>
             <span class="text-black dark:text-slate-300">User Profil</span>
         </a>

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
