<div>
    <button type="button" data-fc-type="modal" data-fc-target="formInputItem{{ $item['id' ?? ''] }}"
        class="inline-block focus:outline-none text-slate-500 hover:bg-slate-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-slate-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-slate-500  text-sm font-medium py-1 px-3 rounded ">
        Laporkan
    </button>
    <div class="modal animate-ModalSlide hidden" id="formInputItem{{ $item['id' ?? ''] }}">
        <div
            class="relative w-auto pointer-events-none sm:max-w-lg sm:my-0 sm:mx-auto z-[99] flex items-center h-[calc(100%-3.5rem)]">
            <div
                class="relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-800 bg-clip-padding rounded">
                <div
                    class="flex shrink-0 items-center justify-between py-2 px-4 rounded-t border-b border-solid dark:border-gray-700 bg-slate-800">
                    <h6 class="mb-0 leading-4 text-base font-semibold text-slate-300 mt-0" id="staticBackdropLabel1">
                        Modal Heading</h6>
                    <button type="button"
                        class="box-content w-4 h-4 p-1 bg-slate-700/60 rounded-full text-slate-300 leading-4 text-xl close"
                        aria-label="Close" data-fc-dismiss>&times;</button>
                </div>
                <form action="">
                    <div class="relative flex-auto p-4 text-slate-600 dark:text-gray-300 leading-relaxed">
                        <p class="font-semibold text-base">Title Text</p>
                        <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, pariatur.
                        </p>
                        <p class="font-semibold text-base mt-3">Subtitle Text</p>
                        <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora eos voluptas
                            saepe officia! Aperiam deleniti laboriosam quo neque non quia, facere, dignissimos impedit
                            fuga
                            hic at culpa iusto similique ad laudantium
                            nesciunt, error consectetur voluptatem ipsa vitae accusamus eaque nihil!
                        </p>
                    </div>
                </form>
                <div
                    class="flex flex-wrap shrink-0 justify-end p-3  rounded-b border-t border-dashed dark:border-gray-700">
                    <button
                        class="inline-block focus:outline-none text-red-500 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-red-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-red-500  text-sm font-medium py-1 px-3 rounded mr-1 close"
                        data-fc-dismiss>Close</button>
                    <button
                        class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500  text-sm font-medium py-1 px-3 rounded">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
