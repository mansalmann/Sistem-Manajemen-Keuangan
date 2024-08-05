<!-- Main Content Wrapper -->
<main class="main-content lg:w-7/12 sm:w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            Tambah Data Transaksi
        </h2>
    </div>

    <form action="/update" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?= $model["waktu_transaksi"] ?>" name="waktu_transaksi">
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
                        name="jumlah" placeholder="Masukkan jumlah transaksi" type="text" value="<?= $model["jumlah"] ?? "" ?>" />
                </label>
                <label class="block mt-3">
                    <span>Deskripsi</span>
                    <textarea rows="4" placeholder="Deksripsi transaksi Anda"
                        class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        name="deskripsi"><?= $model["deskripsi"] ?? "" ?></textarea>
                </label>
                <div class="flex justify-end space-x-2">
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