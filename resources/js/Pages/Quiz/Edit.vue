<script setup>
import Main from '@Layout/Main.vue';
import BtnAction from '../../Components/BtnAction.vue';
import InputSelect from '@Components/InputSelect.vue';
import BtnSubmit from '../../Components/BtnSubmit.vue';
import { ref,computed } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  quiz: Object,
  tiers: Array,
  points: Array,
});
const tierId = ref(props.quiz.tier_id || '');
const questions = ref([
  {
    quiz_text: props.quiz.quiz_text || '',  
    options: props.quiz.answers.map(answer => answer.answer) || [],  // Options from answers
    correctAnswer: props.quiz.answers.find(answer => answer.id = props.quiz.correct_answer)?.answer || '',  // Correct answer based on id
    points: props.quiz.point || 5,  // Points value
    isShowAnswer: true,
  },
]);

console.log(questions.correctAnswer)

const errors = ref({
  tierId: null,
  questions: [], 
});

const tierSlug = computed(() => {
  const tier = props.tiers.find(tier => tier.id === tierId.value);
  return tier ? tier.slug : '';
});

const addOption = (question) => {
  question.options.push(''); // Menambahkan string kosong sebagai opsi jawaban baru
};


// Function to handle form submission
const submit = async () => {
  errors.value = {
    tierId: null,
    questions: [],
  };

  const formData = {
    tierId: tierId.value,
    tierSlug:tierSlug.vue,
    questions: questions.value.map(question => ({
      quiz_text: question.quiz_text,
      options: question.options,
      correctAnswer: question.correctAnswer,
      points: question.points,
    })),
  };

  console.log(formData);

  try {
    await router.put(`/quizs/${props.quiz.id}`, formData);
  } catch (error) {
    if (error.response && error.response.status === 422) {
      errors.value = error.response.data.errors;
    }
  }
};
</script>

<template>
  <Main title="Edit Soal">
    <form @submit.prevent="submit">
      <div class="row">
        <div class="col-md-6">
          <InputSelect
            :options="tiers"
            v-model="tierId"
            :class="{'is-invalid': errors.tierId}"
          />
          <span v-if="errors.tierId" class="text-danger">{{ errors.tierId }}</span>
        </div>
      </div>

      <!-- Question Editing Section -->
      <div class="row my-3">
        <div class="col-md-12 mb-4" v-for="(question, questionIndex) in questions" :key="questionIndex">
          <div class="card">
            <div class="card-header">
              <h5>Pertanyaan {{ questionIndex + 1 }}</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <!-- Question Text Area -->
                <div class="col-md-7">
                  <label class="form-label">Pertanyaan</label>
                  <textarea
                    v-model="question.quiz_text"
                    class="form-control mb-3"
                    :class="{'is-invalid': errors.questions[questionIndex]?.quiz_text}"
                    placeholder="Masukkan pertanyaan di sini..."
                  ></textarea>
                  <span v-if="errors.questions[questionIndex]?.quiz_text" class="text-danger">
                    {{ errors.questions[questionIndex].quiz_text[0] }}
                  </span>
                </div>
                <!-- Options and Correct Answer Selection -->
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
                      class="form-control form-control-sm"
                      :class="{'is-invalid': errors.questions[questionIndex]?.options && errors.questions[questionIndex]?.options[optionIndex]}"
                      placeholder="Masukkan jawaban di sini..."
                    ></textarea>
                    <button type="button" class="btn btn-danger" @click="question.options.splice(optionIndex, 1)">Hapus</button>
                    <span v-if="errors.questions[questionIndex]?.options && errors.questions[questionIndex]?.options[optionIndex]" class="text-danger">
                      {{ errors.questions[questionIndex].options[optionIndex][0] }}
                    </span>
                  </div>
                  <hr>
                  <!-- Correct Answer Dropdown -->
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
                  <!-- Points Dropdown -->
                  <div class="mb-3">
                    <label class="form-label">Bobot</label>
                    <select
                      class="form-select"
                      v-model="question.points"
                      :class="{'is-invalid': errors.questions[questionIndex]?.points}"
                    >
                      <option value="" selected>Pilih bobot</option>
                      <option v-for="point in points" :key="point" :value="point">
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

      <!-- Form Action Buttons -->
      <div class="row my-5">
        <div class="col-md-12 text-end">
          <BtnAction :href="`/quizs/show/${tierSlug}`" color="secondary">Kembali</BtnAction>
          <BtnSubmit text="Simpan" loadingText="Menyimpan..." buttonClass="custom-class" />
        </div>
      </div>
    </form>
  </Main>
</template>
