<main class="main-content w-full px-[var(--margin-x)] pb-8">
  <div class="col-span-12 lg:col-span-8 mt-5">
    <div class="card bg-gradient-to-br from-purple-500 to-indigo-600 px-4 pb-4 sm:px-5 mx-auto">
      <div class="flex items-center mt-5 text-white">
        <h2 class="text-sm+ font-medium tracking-wide">Saldo Anda</h2>
      </div>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:gap-6">
        <div>
          <div class="mt-3 text-3xl font-semibold text-white">
            Rp.<?= number_format($model["results"][count($model["results"]) - 2], 2, ",", ".") ?? "0"; ?>
          </div>
          <p class="mt-3 text-xs+ text-indigo-100">Data terbaru sejak
            <?=
              date("l, j F Y - H:i", strtotime($model["results"][count($model["results"]) - 3][4])); ?>
          </p>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:gap-5 lg:gap-6">
          <div>
            <p class="text-indigo-100">Pemasukan terakhir</p>
            <div class="mt-1 flex items-center space-x-2">
              <div class="flex size-7 items-center justify-center rounded-full bg-black/20 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewbox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12">
                  </path>
                </svg>
              </div>
              <p class="text-base font-medium text-white">Rp.<?= number_format($model["results"][count($model["results"]) - 1][0], 2, ",", ".") ?? "0"; ?></p>
            </div>

            <button
              class="btn mt-3 w-full border border-white/10 bg-white/20 text-white hover:bg-white/30 focus:bg-white/30">
              Uang masuk
            </button>
          </div>
          <div>
            <p class="text-indigo-100">Pengeluaran terakhir</p>
            <div class="mt-1 flex items-center space-x-2">
              <div class="flex size-7 items-center justify-center rounded-full bg-black/20 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewbox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6">
                  </path>
                </svg>
              </div>
              <p class="text-base font-medium text-white">Rp.<?= number_format($model["results"][count($model["results"]) - 1][1], 2, ",", ".") ?? "0"; ?></p>
            </div>
            <button
              class="btn mt-3 w-full border border-white/10 bg-white/20 text-white hover:bg-white/30 focus:bg-white/30">
              Uang Keluar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- tabel catatan keuangan -->
    <div class="is-scrollbar-hidden min-w-full overflow-x-auto mt-5">
      <table class="is-hoverable w-full text-left">
        <thead>
          <tr>
            <th
              class="whitespace-nowrap rounded-l-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              No.
            </th>
            <th
              class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Jenis Transaksi
            </th>
            <th
              class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Aktivitas Transaksi
            </th>
            <th
              class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Jumlah
            </th>
            <th
              class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Waktu Transaksi
            </th>
            <th
              class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Deskripsi
            </th>
            <th
              class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Aksi
            </th>
          </tr>
        </thead>
        <tbody>
          <?php

          for ($i = 0; $i < count($model["results"]) - 2; $i++) { ?>

            <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
              <td class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5"><?= $i + 1 ?></td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= $model["results"][$i][0] ?></td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5"><?= $model["results"][$i][1] ?></td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">Rp.<?= number_format($model["results"][$i][2], 2, ",", ".") ?>
              </td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                <?=
                  date("l, j F Y - H:i:s", strtotime($model["results"][$i][4])); ?>
              </td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                <!-- popover -->
                <div x-data="usePopper({
              offset: 12,
              placement: 'right-start',
              modifiers: [
                  {name: 'flip', options: {fallbackPlacements: ['bottom','top']}},
                  {name: 'preventOverflow', options: {padding: 10}}
              ]
            })" @click.outside="isShowPopper && (isShowPopper = false)" class="flex">
                  <button
                    class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                    x-ref="popperRef" @click="isShowPopper = !isShowPopper">
                    Lihat Deskripsi
                  </button>
                  <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                    <div class="popper-box max-w-xs">
                      <div class="rounded-md border border-slate-150 bg-white p-4 dark:border-navy-600 dark:bg-navy-700">
                        <div style="white-space:normal;">
                          <?= $model["results"][$i][3] ?>
                        </div>
                      </div>
                      <div class="size-4" data-popper-arrow>
                        <svg viewBox="0 0 16 9" xmlns="http://www.w3.org/2000/svg" class="absolute size-4"
                          fill="currentColor">
                          <path class="text-slate-150 dark:text-navy-600"
                            d="M1.5 8.357s-.48.624 2.754-4.779C5.583 1.35 6.796.01 8 0c1.204-.009 2.417 1.33 3.76 3.578 3.253 5.43 2.74 4.78 2.74 4.78h-13z" />
                          <path class="text-white dark:text-navy-700"
                            d="M0 9s1.796-.017 4.67-4.648C5.853 2.442 6.93 1.293 8 1.286c1.07-.008 2.147 1.14 3.343 3.066C14.233 9.006 15.999 9 15.999 9H0z" />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
              <td class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5">
                <!-- opsi titik tiga -->
                <div x-data="usePopper({placement:'bottom-end',offset:4})"
                  @click.outside="isShowPopper && (isShowPopper = false)" class="inline-flex">
                  <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                    class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                  </button>

                  <!-- opsi -->
                  <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                    <div
                      class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                      <ul>
                        <li>
                          <!-- tombol hapus -->
                          <div x-data="{showModal:false}">
                            <button @click="showModal = true"
                              class="flex items-center w-full px-3 h-8 pr-10 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                              Hapus
                            </button>
                            <template x-teleport="#x-teleport-target">
                              <div
                                class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                                x-show="showModal" role="dialog" @keydown.window.escape="showModal = false">
                                <div class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                                  @click="showModal = false" x-show="showModal" x-transition:enter="ease-out"
                                  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                  x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
                                  x-transition:leave-end="opacity-0"></div>
                                <div
                                  class="relative max-w-sm rounded-lg bg-white px-4 pb-4 transition-all duration-300 dark:bg-navy-700 sm:px-5"
                                  x-show="showModal" x-transition:enter="easy-out"
                                  x-transition:enter-start="opacity-0 [transform:translate3d(0,-1rem,0)]"
                                  x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                  x-transition:leave="easy-in"
                                  x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                                  x-transition:leave-end="opacity-0 [transform:translate3d(0,-1rem,0)]">
                                  <div class="mt-4">
                                    Anda yakin akan menghapus data transaksi ini?
                                  </div>
                                  <div class="mt-4 text-center flex justify-evenly">
                                    <a class="btn h-8 rounded-full text-xs+ font-medium text-slate-700 hover:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-100 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25"
                                      href="/dashboard">
                                      Batalkan
                                    </a>
                                    <form method="post" action="/delete">
                                      <input type="hidden" value="<?= $model["results"][$i][4] ?>" name="datetime">
                                      <button @click="showModal = false"
                                        class="btn h-8 rounded-full bg-primary text-xs+ font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                        type="submit">
                                        Hapus
                                      </button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </template>
                          </div>
                        </li>
                        <li>
                          <form action="/updates" method="post">
                            <input type="hidden" value="<?= $model["results"][$i][0] ?>" name="jenis_kategori">
                            <input type="hidden" value="<?= $model["results"][$i][1] ?>" name="sub_kategori">
                            <input type="hidden" value="<?= $model["results"][$i][2] ?>" name="jumlah">
                            <input type="hidden" value="<?= $model["results"][$i][3] ?>" name="deskripsi">
                            <input type="hidden" value="<?= $model["results"][$i][4] ?>" name="waktu_transaksi">
                            <input
                              class="cursor-pointer flex items-center px-3 h-8 pr-12 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              value="Edit" type="submit">
                          </form>

                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
  
</main>
