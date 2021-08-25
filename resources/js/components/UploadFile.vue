<template>
  <div class="container">
    <div class="large-12 medium-12 small-12 cell">
      <label>Сторона {{side === 0?"А":"В"}}
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
    props: ['getPhotoLink', 'side'],
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
            formData.append('side', this.side);
            axios
                .post( 'files/upload', formData, config)
                .then(response =>{
                    this.getPhotoLink(response.data);
                this.file = null;
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