<template>
    <div class="container-fluid">
        <div class="row justify-content-center py-2">
            <div class="col-6">
                <label for="value">Переменная</label>
                <input type="text" v-model="firstname" id="value" class="form-control">
            </div>
        </div>
        <div class="row justify-content-center py-2">
            <div class="col-6">
                <file-pond name="word" ref="pond" class-name="my-pond" label-idle="Перетащите файлы"
                           allow-multiple="false" :allow-file-type-validation="false"/>
            </div>
        </div>
        <div class="row justify-content-center py-2">
            <div class="col-6">
                <input type="button" class="btn btn-primary" value="Отправить" @click.prevent="sendDocument">
            </div>
        </div>
    </div>
</template>

<script lang="js">
import {defineComponent, ref} from "vue";
import vueFilePond from 'vue-filepond'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type'
import 'filepond/dist/filepond.min.css'
import axios from "axios";
import {saveAs} from 'file-saver'

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
)
export default defineComponent({
    components: {
        FilePond
    },
    setup() {
        let firstname = ref('');
        let pond = ref();

        const sendDocument = async () => {
            let fd = new FormData();
            fd.append('firstname', firstname.value);
            fd.append('word', pond.value.getFile().file)
            await axios.post('/word', fd, {
                responseType: "blob"
            })
                .then(result => {
                    console.log(result)
                    saveAs(result.data, 'word.pdf')
                });
        }

        return {firstname, pond, sendDocument}
    }
})
</script>

<style scoped>

</style>
