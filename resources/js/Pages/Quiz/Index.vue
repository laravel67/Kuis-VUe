<script setup>
import Main from '@Layout/Main.vue';
import BtnCreate from '@Components/BtnCreate.vue';
import BtnAction from '@Components/BtnAction.vue';
import App from '../../Layouts/App.vue';
import BtnDanger from '../../Components/BtnDanger.vue';
import BtnGreen from '../../Components/BtnGreen.vue';
const props = defineProps({
  tiers: Array,
  startIndex: {
    type: Number,
    default: 1
  }
});
</script>

<template>
  <App title="Kelola Soal">
    <div class="row">
      <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Responsive Table</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">ZIP</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>jhon@email.com</td>
                                            <td>USA</td>
                                            <td>123</td>
                                            <td>Member</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>mark@email.com</td>
                                            <td>UK</td>
                                            <td>456</td>
                                            <td>Member</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>jacob@email.com</td>
                                            <td>AU</td>
                                            <td>789</td>
                                            <td>Member</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
  <!-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
          <BtnCreate href="/quizs/create">Tambah Soal</BtnCreate>
        </caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Tingkat
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah Soal
                </th>
                <th scope="col" class="px-6 py-3">
                    Opsi
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="(tier, i) in tiers" :key="tier.slug">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  {{ startIndex + i }}
                </th>
                <td class="px-6 py-4">
                  {{ tier.name }}
                </td>
                <td class="px-6 py-4">
                  {{ tier.quizzes?.length || 0 }} Butir
                </td>
                <td class="px-6 py-4">
                  <BtnGreen :href="`/quizs/show/${tier.slug}`">Lihat</BtnGreen>
                  <BtnDanger>Hapus</BtnDanger>
                </td>
            </tr>
            <tr v-if="tiers.length === 0">
                  <td colspan="4">No data available</td>
            </tr>
        </tbody>
    </table>
</div> -->

    <!-- <div class="row">
      <div class="col-md-12">
        <BtnCreate href="/quizs/create" />
        <div class="card">
          <h5 class="card-header">Daftar Kuis</h5>
          <div class="table-responsive">
            <table class="table table-striped table-borderless border-bottom">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tingkat</th>
                  <th>Jumlah Soal</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(tier, i) in tiers" :key="tier.slug">
                  <td>{{ startIndex + i }}</td>
                  <td>{{ tier.name }}</td>
                  <td>{{ tier.quizzes?.length || 0 }} Butir</td>
                  <td>
                    <BtnAction :href="`/quizs/show/${tier.slug}`" color="success btn-sm">
                              <i class="bx bx-book-content"></i>
                    </BtnAction>
                  </td>
                </tr>
                <tr v-if="tiers.length === 0">
                  <td colspan="4">No data available</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> -->
  </App>
</template>
