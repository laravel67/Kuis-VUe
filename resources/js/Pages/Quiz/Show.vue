<script setup>
// Importing necessary components
import Main from '@Layout/Main.vue';
import BtnBadge from '@Components/BtnBadge.vue';
import BtnAction from '@Components/BtnAction.vue';

// Defining the props and their types
const props = defineProps({
  tier: Object,        // Object representing the current tier
  quizzes: Array,      // Array of quiz objects
  tierName: String,    // Name of the tier
  answers: Object,     // Object with quiz IDs as keys and arrays of answers as values
});
function getAnswerLabel(correctAnswer, answers) {
  const index = answers.findIndex(answer => answer.answer === correctAnswer);
  return index !== -1 ? String.fromCharCode(65 + index) : '';
}
</script>

<template>
  <!-- Main layout wrapper -->
  <Main>
    <div class="container mb-5">
      <!-- Displaying the tier name -->
      <h1>Kuis Tingkat: {{ tierName }}</h1>

      <!-- Back button to return to the quizzes list -->
      <div class="card-header d-flex align-items-center">
        <BtnAction :href="`/quizs`" color="secondary">Kembali</BtnAction>
      </div>

      <!-- Loop through each quiz -->
      <div v-for="(quiz, index) in quizzes" :key="quiz.id" class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 mb-xl-0">
              <!-- Quiz details -->
              <span class="badge bg-dark mx-1">{{ 'No. ' + (index + 1) }}</span>
              <span class="badge bg-secondary mx-1">{{ 'Bobot ' + quiz.point }}</span>
              <BtnBadge :href="`/quizs/${quiz.id}/edit`" bgClass="warning">Ubah Soal</BtnBadge>
              <article class="p-2" v-html="quiz.quiz_text"></article>
            </div>
            <div class="col-lg-6">
              <div class="demo-inline-spacing mb-3">
                <ul class="list-group">
                  <!-- Loop through each answer of the current quiz -->
                  <li v-for="(answer, optionIndex) in answers[quiz.id]" :key="optionIndex" class="list-group-item d-flex text-start align-items-center">
                    <span class="badge bg-primary me-2">{{ String.fromCharCode(65 + optionIndex) }}</span>
                    {{ answer.answer }}
                  </li>
                </ul>

                <!-- Display correct answer -->
                <span>Kunci Jawaban:</span> 
                <div class="alert alert-success text-dark my-2">
                  <strong>
                    <span class="badge bg-success">
                      {{ getAnswerLabel(quiz.correct_answer, answers[quiz.id]) }}
                    </span>
                    {{ quiz.correct_answer }}
                  </strong>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Main>
</template>
