<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({

    exam: {
        type: Object
    },
    student: {
        type: Object
    },
    subjects: {
        type: Array
    }

});
const removeResult = (index) => {
    form.results.splice(index, 1);
}
const addResult = () => {
    form.results.push({ subject_id: "", grade: "" });
}

// const options = ref([
//     { text: 'Math', value: 1 },
//     { text: 'Science', value: 2 },
//     { text: 'English', value: 3 }
// ])
const form = useForm({
    index_no: props.exam.index_no,
    type: props.exam.type,
    exam_year: props.exam.exam_year,
    //shedule_date: new Date().toISOString().split('T')[0],
    attempt: props.exam.attempt,
    island_rank: props.exam.island_rank,
    district_rank: props.exam.district_rank,
    z_score: props.exam.z_score,
    cut_of_marks: props.exam.cut_of_marks,
    subject_stream: props.exam.subject_stream,
    is_pass: props.exam.is_pass,
    results: props.exam.results

});
/*const form = useForm({
    index_no: 6547,
    type: "al",
    exam_year: 2007,
    //shedule_date: new Date().toISOString().split('T')[0],
    attempt: 1,
    island_rank: 340,
    district_rank: 13,
    z_score: 3,
    cut_of_marks: "",
    subject_stream: "Science",
    is_pass: false,
    results: [{ subject_id: 1, grade: "S" }, { subject_id: 2, grade: "B" }, { subject_id: 3, grade: "C" }]

});*/

</script>
<template>
    <Head title="Add Exam" />
    <AuthenticatedLayout>
        <!-- <div>{{ exam }}</div>
        <div>{{ subjects }}</div>
         -->
        <div>{{ student.first_name }} {{ student.last_name }}</div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form @submit.prevent="form.put(route('exam.update', { studentId: student.id, examId: exam.id }))"
                class="mt-6 space-y-6">

                <div>
                    <InputLabel for="indexNo" value="Index No" />
                    <input type="number" id="indexNo" v-model="form.index_no" />
                    <InputError class="mt-2" :message="form.errors.index_no" />
                </div>
                <div>
                    <InputLabel for="tpy" value="Type" />
                    <input type="text" id="tpy" v-model="form.type">
                    <InputError class="mt-2" :message="form.errors.type" />
                </div>
                <div>
                    <InputLabel for="examYr" value="Exam Year" />
                    <input type="number" id="examYr" v-model="form.exam_year">
                    <InputError class="mt-2" :message="form.errors.exam_year" />
                </div>
                <div>
                    <InputLabel for="attempt" value="Attempt" />
                    <input type="number" id="attempt" v-model="form.attempt">
                    <InputError class="mt-2" :message="form.errors.attempt" />
                </div>
                <div>
                    <InputLabel for="islandRank" value="Island Rank" />
                    <input type="number" id="islandRank" v-model="form.island_rank">
                    <InputError class="mt-2" :message="form.errors.island_rank" />
                </div>
                <div>
                    <InputLabel for="districtRank" value="District Rank" />
                    <input type="number" id="districtRank" v-model="form.district_rank">
                    <InputError class="mt-2" :message="form.errors.district_ranks" />
                </div>
                <div>
                    <InputLabel for="zScore" value="Z Score" />
                    <input type="number" id="zScore" v-model="form.z_score">
                    <InputError class="mt-2" :message="form.errors.z_score" />
                </div>
                <div>
                    <InputLabel for="cutoffMarks" value="Cutoff Marks" />
                    <input type="number" id="cutoffMarks" v-model="form.cut_of_marks">
                    <InputError class="mt-2" :message="form.errors.cut_of_marks" />
                </div>
                <div>
                    <InputLabel for="subjectStream" value="Subject stream" />
                    <input type="text" id="subjectStream" v-model="form.subject_stream">
                    <InputError class="mt-2" :message="form.errors.subject_stream" />
                </div>
                <div>


                    <InputError class="mt-2" :message="form.errors.is_pass" />
                    <input type="checkbox" id="check_box" v-model="form.is_pass" />
                    <label for="check_box">Pass</label>
                </div>

                <div>
                    <div v-for="(result, index) in form.results" :key="index" class="flex items-center gap-4">
                        <div>
                            <InputLabel :for="'subject' + index" :value="'Subject ' + (index + 1)" />
                            <div>
                                <select v-model="result.subject_id">
                                    <option v-for=" subject in subjects" :value="subject.id">
                                        {{ subject.name }}
                                        {{ subject.code }}
                                    </option>
                                </select>
                                <!-- <select v-model="result.subject_id">
                            <option :value="1">Math</option>
                            <option :value="2">Science</option>
                            <option :value="3">english</option>
                        </select> -->

                                <!-- <div>Selected: {{ result.subject_id }}</div> -->
                            </div>

                            <!-- k<input type="text" :id="'subject' + index" v-model="result.subject_id" /> -->

                        </div>
                        <div>
                            <InputLabel :for="'grade' + index" :value="'Grade ' + (index + 1)" />
                            <!--  <div>Selected: {{ result.grade }}</div> -->

                            <select v-model="result.grade">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                            </select>
                            <!-- <input type="text" :id="'grade' + index" v-model="result.grade" /> -->
                        </div>
                        <button type="button" v-if="index > 0" @click="removeResult(index)">Remove</button>
                        <button type="button" v-if="index < 9" @click="addResult">Add</button>
                    </div>
                    <div v-if="result === null">++++++++++++++++
                        <div v-for="(result, index) in form.results" :key="index" class="flex items-center gap-4">
                            <div>
                                <InputLabel :for="'subject' + index" :value="'Subject ' + (index + 1)" />
                                <div>
                                    <select v-model="result.subject_id">
                                        <option v-for=" subject in subjects" :value="subject.id">
                                            {{ subject.name }}
                                            {{ subject.code }}
                                        </option>
                                    </select>
                                    <!-- <select v-model="result.subject_id">
                            <option :value="1">Math</option>
                            <option :value="2">Science</option>
                            <option :value="3">english</option>
                        </select> -->

                                    <!-- <div>Selected: {{ result.subject_id }}</div> -->
                                </div>

                                <!-- k<input type="text" :id="'subject' + index" v-model="result.subject_id" /> -->

                            </div>
                            <div>
                                <InputLabel :for="'grade' + index" :value="'Grade ' + (index + 1)" />
                                <!--  <div>Selected: {{ result.grade }}</div> -->

                                <select v-model="result.grade">
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                                <!-- <input type="text" :id="'grade' + index" v-model="result.grade" /> -->
                            </div>
                            <button type="button" v-if="index > 0" @click="removeResult(index)">Remove</button>
                            <button type="button" v-if="index < 9" @click="addResult">Add</button>
                        </div>
                    </div>
                    <div class="mt-2">
                        <!-- <button @click="addResult">Add Result</button> -->
                    </div>
                </div>



                <div class="flex items-center gap-4">
                    <!-- <button @click="storeExamDetails(student.id)">Save</button> -->
                    <PrimaryButton :disabled="form.processing">Update</PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>