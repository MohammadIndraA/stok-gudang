<!--Red Modal-->
<div class="modal animate-ModalSlide hidden" id="{{ $modalId }}">
    <div class="relative w-auto pointer-events-none sm:max-w-lg sm:my-7 sm:mx-auto z-[99]">
        <div
            class="relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-800 bg-clip-padding rounded">
            <div
                class="flex shrink-0 items-center justify-between py-2 px-4 rounded-t border-b border-solid dark:border-gray-700 bg-red-500">
                <h6 class="mb-0 leading-4 text-base font-semibold text-white mt-0" id="staticBackdropLabel1">Green Modal
                </h6>
                <button type="button"
                    class="box-content w-4 h-4 p-1 bg-red-700/60 rounded-full text-slate-300 leading-4 text-xl close"
                    aria-label="Close" data-fc-dismiss>&times;</button>
            </div>
            <div class="relative flex-auto p-4 text-slate-600 dark:text-gray-300 leading-relaxed">
                <div class="grid grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-12 lg:col-span-4 xl:col-span-4">
                        <img src="assets/images/widgets/wallet.png" alt="" class="h-32 w-32">
                    </div>
                    <div class="col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-8">
                        <h5 class="text-gray-700 mr-3 dark:text-slate-200 text-lg font-medium">Crypto Market Services
                        </h5>
                        <p class="truncate text-gray-500 dark:text-slate-500 text-sm font-normal">
                            <span
                                class="bg-slate-600/5 text-slate-500 text-[11px] font-medium px-2.5 py-0.5 rounded h-5">Disable
                                Services</span>
                            07 Oct 2023
                        </p>
                        <ul class="list-disc list-inside mt-3">
                            <li class="mb-1 text-slate-700 dark:text-slate-400 text-sm">Lorem Ipsum is dummy text.</li>
                            <li class="mb-1 text-slate-700 dark:text-slate-400 text-sm">It is a long established reader.
                            </li>
                            <li class="mb-1 text-slate-700 dark:text-slate-400 text-sm">Contrary to popular belief,
                                Lorem simply.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap shrink-0 justify-end p-3  rounded-b border-t border-dashed dark:border-gray-700">
                <button
                    class="inline-block focus:outline-none text-slate-500 hover:bg-slate-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-slate-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-slate-500  text-sm font-medium py-1 px-3 rounded mr-1 btn-close"
                    data-fc-dismiss>Close</button>
                <button
                    class="inline-block focus:outline-none text-red-500 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-red-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-red-500  text-sm font-medium py-1 px-3 rounded">Save</button>
            </div>
        </div>
    </div>
</div>
