<template>
  <div class="container">
    <div class="large-12 medium-12 small-12 cell">
      <label>File
        <input
                  label="Выберите файл"
                  prepend-icon="attach_file"
                  type="file"
                  ref="file"
                  name="file"
                  @change="handleFileUpload"
                />
      </label>
      <button @click="submitFile()">Отправить</button>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return {
        file: null
      }
    },

    methods: {

      submitFile(){
            let config = { "Content-Type": "multipart/form-data" };
            let formData = new FormData();
            formData.append('file', this.file);
            axios.post( 'files/upload', formData, config).then(function(){
          console.log('SUCCESS!!');
        })
        .catch(function(){
          console.log('FAILURE!!');
        });
      },
      handleFileUpload(){
        this.file = this.$refs.file.files[0];
      }
    }
  }
</script>