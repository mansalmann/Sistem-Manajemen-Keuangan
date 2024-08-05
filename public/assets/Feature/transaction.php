<!-- Main Content Wrapper -->
<main class="main-content lg:w-7/12 sm:w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            Tambah Data Transaksi
        </h2>
    </div>

    <form action="/transaction" method="post" enctype="multipart/form-data">

        <div class="card p-4 sm:p-5 w-full">
            <?php if (isset($model["error"])) { ?>
                <div class="text-error" role="alert">
                    <?= $model["error"] ?>
                </div>
            <?php } ?>
            <div class="mt-4 space-y-4">
                <label class="block">
                    <span>Jenis Transaksi</span>
                    <select
                        class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent jenisTransaksi"
                        name="jenis_kategori">
                        <option value="Pemasukan">Pemasukan</option>
                        <option value="Pengeluaran">Pengeluaran</option>
                    </select>
                </label>
                <label class="block">
                    <span>Aktivitas Transaksi</span>
                    <select
                        class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent tipeTransaksi"
                        name="sub_kategori">
                    </select>
                </label>
                <label class="block">
                    <span>Jumlah Transaksi Anda (Rp.)</span>
                    <input x-input-mask="config"
                        class="form-input w-full rounded-lg border border-slate-300 bg-transparent mt-1.5 px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        name="jumlah" placeholder="Masukkan jumlah transaksi" type="text" />
                </label>
                <label class="block mt-3">
                    <span>Deskripsi</span>
                    <textarea rows="4" placeholder="Deksripsi transaksi Anda"
                        class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        name="deskripsi"></textarea>
                </label>
                <div class="flex justify-between space-x-2">
                    <!-- tombol tambah aktivitas transaksi -->
                    <!-- <button
                        class="btn p-0 space-x-2 font-medium text-primary
                        dark:text-white"
                        type="button" name="button">
                        Tambah Aktivitas Transaksi
                    </button> -->
                    <div x-data="{showModal:false}">
                        <button @click="showModal = true"
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                            type="button">
                            Tambah Aktivitas Transaksi
                        </button>
                        <template x-teleport="#x-teleport-target">
                            <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                                x-show="showModal" role="dialog" @keydown.window.escape="showModal = false">
                                <div class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                                    @click="showModal = false" x-show="showModal" x-transition:enter="ease-out"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"></div>
                                <div class="relative w-full max-w-lg origin-top rounded-lg bg-white transition-all duration-300 dark:bg-navy-700"
                                    x-show="showModal" x-transition:enter="easy-out"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="easy-in"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95">
                                    <div
                                        class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                                            Tambah Aktivitas Transaksi
                                        </h3>
                                        <button @click="showModal = !showModal"
                                            class="btn -mr-1.5 size-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="px-4 py-4 sm:px-5">
                                        <div class="mt-4 space-y-4">
                                            <form action="/activity" method="post">
                                                <label class="block">
                                                    <span>Pilih jenis transaksi :</span>
                                                    <select
                                                        class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent" name="jenis_kategori">
                                                        <option value="Pemasukan">Pemasukan</option>
                                                        <option value="Pengeluaran">Pengeluaran</option>
                                                    </select>
                                                </label>
                                                <label class="block mt-2">
                                                    <span>Masukkan nama aktivitas transaksi</span>
                                                    <input x-input-mask="config"
                                                        class="form-input w-full rounded-lg border border-slate-300 bg-transparent mt-1.5 px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                        name="sub_kategori"
                                                        type="text"required/>
                                                </label>
                                                <div class="mt-3 space-x-2 text-right">
                                                    <button @click="showModal=false"
                                                        class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                                        Batal
                                                    </button>
                                                    <button 
                                                        class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90" type="submit"
                                                        >
                                                        Submit
                                                    </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </template>
                </div>
                <!-- tombol submit data transaksi -->
                <button
                    class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                    type="submit" name="submit">
                    Submit
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewbox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </form>
    </div>

</main>
</div>