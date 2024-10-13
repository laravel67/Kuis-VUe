<script setup>
import App from '@Layout/App.vue';
import BtnAction from '../../Components/BtnAction.vue';
import InputSelect from '@Components/InputSelect.vue';
import InputLabel from '../../Components/InputLabel.vue';
import CardFull from '../../Components/CardFull.vue';
import BtnSubmit from '../../Components/BtnSubmit.vue';
import { ref, nextTick, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  tiers: Array,
  points: Array,
});

const tierId = ref('');
const pointsOptions = ref(props.points || []);
const questions = ref([
  {
    quiz_text: '',
    options: [],
    correctAnswer: '',
    points: 5,
    isShowAnswer: true,
  },
]);

const errors = ref({
  tierId: null,
  questions: [],
});

const initSummernote = () => {
  $('.summernote').summernote({
    height: 100, // Set the height of the editor
    placeholder: 'Masukkan pertanyaan di sini...',
  });
};

const addQuestion = () => {
  questions.value.push({
    quiz_text: '',
    options: [],
    correctAnswer: '',
    points: null,
    isShowAnswer: true,
  });

  // Use nextTick to reinitialize Summernote after DOM update
  nextTick(() => {
    initSummernote();
  });
};

const removeQuestion = (index) => {
  questions.value.splice(index, 1);
};

const addOption = (question) => {
  if (question.options.length < 4) {
    question.options.push('');
  } else {
    alert('Anda hanya dapat menambahkan hingga 4 jawaban.');
  }
};

const simulateDelay = (ms) => new Promise(resolve => setTimeout(resolve, ms));
const submit = async () => {
  errors.value = {
    tierId: null,
    questions: [],
  };
  
  // Update questions' quiz_text from Summernote before submission
  questions.value.forEach((question, index) => {
    question.quiz_text = $(`#summernote-${index}`).val();
  });

  await simulateDelay(2000);
  const formData = {
    tierId: tierId.value,
    questions: questions.value.map(question => ({
      quiz_text: question.quiz_text,
      options: question.options,
      correctAnswer: question.correctAnswer,
      points: question.points,
    })),
  };

  console.log(formData);

  try {
    await router.post('/quizs', formData);
  } catch (error) {
    if (error.response && error.response.status === 422) {
      errors.value = error.response.data.errors;
    }
  }
};

// Initialize Summernote when component is mounted
onMounted(() => {
  initSummernote();
});
</script>

<template>
  <App title="Kelola Soal">

    <form @submit.prevent="submit">
      <InputSelect
      :options="props.tiers"
      v-model="tierId"
      :class="{'is-invalid': errors.tierId}"/>

<InputLabel>Pertanyaan</InputLabel>
      <CardFull v-for="(question, questionIndex) in questions" :key="questionIndex">
        <textarea
                    :id="`summernote-${questionIndex}`"
                    v-model="question.quiz_text"
                    class="form-control summernote mb-3"
                    :class="{'is-invalid': errors.questions[questionIndex]?.quiz_text}"
                    placeholder="Masukkan pertanyaan di sini..."
                  ></textarea>

      </CardFull>





    </form>


    <form @submit.prevent="submit">
      <div class="row">
        <div class="col-md-6">
          
          <span v-if="errors.tierId" class="text-danger">{{ errors.tierId }}</span>
        </div>
      </div>

      <div class="row my-3">
        <div class="col-md-12 mb-4" v-for="(question, questionIndex) in questions" :key="questionIndex">
          <div class="card">
            <div class="card-header">
              <h5>Pertanyaan {{ questionIndex + 1 }}</h5>
              <button type="button" class="btn btn-danger btn-sm" @click="removeQuestion(questionIndex)">Hapus</button>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-7">
                  <label class="form-label">Pertanyaan</label>
                  <textarea
                    :id="`summernote-${questionIndex}`"
                    v-model="question.quiz_text"
                    class="form-control summernote mb-3"
                    :class="{'is-invalid': errors.questions[questionIndex]?.quiz_text}"
                    placeholder="Masukkan pertanyaan di sini..."
                  ></textarea>
                  <span v-if="errors.questions[questionIndex]?.quiz_text" class="text-danger">
                    {{ errors.questions[questionIndex].quiz_text[0] }}
                  </span>
                </div>
                <div class="col-md-5">
                  <button type="button" class="btn btn-secondary mb-3" @click="addOption(question)">
                    <i class="bx bx-plus-circle"></i> Jawaban
                  </button>
                  <div class="input-group mb-2" v-for="(option, optionIndex) in question.options" :key="optionIndex">
                    <span class="input-group-text fw-bolder">
                      {{ String.fromCharCode(65 + optionIndex) }}
                    </span>
                    <textarea
                      v-model="question.options[optionIndex]"
                      class="form-control form-control-sm "
                      :class="{'is-invalid': errors.questions[questionIndex]?.options && errors.questions[questionIndex]?.options[optionIndex]}"
                      placeholder="Masukkan jawaban di sini..."
                    ></textarea>
                    <button type="button" class="btn btn-danger" @click="question.options.splice(optionIndex, 1)">Hapus</button>
                    <span v-if="errors.questions[questionIndex]?.options && errors.questions[questionIndex]?.options[optionIndex]" class="text-danger">
                      {{ errors.questions[questionIndex].options[optionIndex][0] }}
                    </span>
                  </div>
                  <hr>
                  <!-- Dropdown untuk memilih jawaban benar -->
                  <div class="mb-3" v-if="question.isShowAnswer">
                    <label class="form-label">Jawaban Benar</label>
                    <select
                      class="form-select"
                      v-model="question.correctAnswer"
                      :class="{'is-invalid': errors.questions[questionIndex]?.correctAnswer}"
                    >
                      <option value="" selected>Pilih jawaban yang benar</option>
                      <option v-for="(option, index) in question.options" :key="index" :value="option">
                        {{ String.fromCharCode(65 + index) }}. {{ option }}
                      </option>
                    </select>
                    <span v-if="errors.questions[questionIndex]?.correctAnswer" class="text-danger">
                      {{ errors.questions[questionIndex].correctAnswer[0] }}
                    </span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Bobot</label>
                    <select
                      class="form-select"
                      v-model="question.points"
                      :class="{'is-invalid': errors.questions[questionIndex]?.points}"
                    >
                      <option value="" selected>Pilih bobot</option>
                      <option v-for="point in pointsOptions" :key="point" :value="point">
                        {{ point }}
                      </option>
                    </select>
                    <span v-if="errors.questions[questionIndex]?.points" class="text-danger">
                      {{ errors.questions[questionIndex].points[0] }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row my-5">
        <div class="col-md-12 text-end">
          <BtnAction :href="`/quizs`" color="secondary">Kembali</BtnAction>
          <button type="button" class="btn btn-primary me-2" @click="addQuestion">
            <i class="bx bx-plus-circle"></i> Tambah
          </button>
          <BtnSubmit text="Simpan" loadingText="Menyimpan..." buttonClass="custom-class" />
        </div>
      </div>
    </form>
  </App>
</template>
