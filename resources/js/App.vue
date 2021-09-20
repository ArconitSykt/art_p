<template>
  <v-app>
    <v-main>
      <v-container fluid>
        <v-data-table
          :headers="headers"
          :items="items"
          :search="search"
          :single-expand="singleExpand"
          :expanded.sync="expanded"
          show-expand
          item-key="id_item"
          sort-by="name_item"
          class="elevation-1"
        >
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>ART</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Поиск"
                single-line
                hide-details
              ></v-text-field>

              <v-dialog v-model="dialog" max-width="700px">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2 ml-2"
                    v-bind="attrs"
                    v-on="on"
                  >
                    Новый элемент
                  </v-btn>
                  <v-btn
                    @click="
                      expanded.lenght > 0 ? (expanded = []) : (expanded = items)
                    "
                    >Раскрыть все</v-btn
                  >
                </template>
                <v-card>
                  <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                  </v-card-title>

                  <v-card-text>
                    <v-container>
                      <v-row>
                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.name_item"
                            label="Наименование"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <v-switch
                            v-model="editedItem.type_item"
                            :label="`Тип: ${
                              editedItem.type_item == true
                                ? 'Динамика'
                                : 'Статика'
                            }`"
                          ></v-switch>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <v-switch
                            v-model="editedItem.light_item"
                            :label="`Свет: ${
                              editedItem.light_item == true ? 'Да' : 'Нет'
                            }`"
                          ></v-switch>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model.number="editedItem.price_item"
                            label="Цена"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.make_price_item"
                            label="Цена создания"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.mount_price_item"
                            label="Цена монтирования"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <UploadFile
                            :side="0"
                            :getPhotoLink="getPhotoLink"
                          ></UploadFile>
                          <v-img
                            :lazy-src="editedItem.photo_b_item"
                            max-height="150"
                            max-width="250"
                            :src="editedItem.photo_a_item"
                          ></v-img>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <UploadFile
                            :side="1"
                            :getPhotoLink="getPhotoLink"
                          ></UploadFile>
                          <v-img
                            :lazy-src="editedItem.photo_b_item"
                            max-height="150"
                            max-width="250"
                            :src="editedItem.photo_b_item"
                          ></v-img>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.location_item"
                            label="Расположение"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.tech_item"
                            label="Тех"
                          ></v-text-field>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-card-text>

                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">
                      Отменить
                    </v-btn>
                    <v-btn color="blue darken-1" text @click="save">
                      Сохранить
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
              <v-dialog v-model="dialogDelete" max-width="500px">
                <v-card>
                  <v-card-title class="headline"
                    >Вы хотите удалить этот элемент?</v-card-title
                  >
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="closeDelete"
                      >Отмена</v-btn
                    >
                    <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                      >Удалить</v-btn
                    >
                    <v-spacer></v-spacer>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-toolbar>
          </template>

          <template v-slot:expanded-item="{ item }">
            <td :colspan="headers.length">
              <v-container><Side></Side></v-container>
            </td>
          </template>

          <template v-slot:item.type_item="{ item }">
            {{ item.type_item == true ? "Динамика" : "Статика" }}
          </template>
          <template v-slot:item.light_item="{ item }">
            {{ item.light_item == true ? "Да" : "Нет" }}
          </template>
          <template v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">
              mdi-pencil
            </v-icon>
            <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
          </template>
          <template v-slot:no-data>
            <v-btn color="primary" @click="initialize"> Обновить </v-btn>
          </template>
        </v-data-table>
      </v-container>
    </v-main>
    <v-footer app></v-footer>
  </v-app>
</template>

<script>
import UploadFile from "./components/UploadFile.vue";
import Side from "./components/Side.vue";

export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    expanded: [],
    singleExpand: false,
    headers: [
      { value: "name_item", text: "Наименование" },
      { value: "type_item", text: "Тип" },
      { value: "light_item", text: "Свет" },
      { value: "price_item", text: "Цена аренды" },
      { value: "make_price_item", text: "Цена изготовления" },
      { value: "mount_price_item", text: "Цена монтаж" },
      { value: "location_item", text: "Локация" },
      { value: "tech_item", text: "Тех требования" },
      { text: "Функции", value: "actions", sortable: false },
      { text: "Месяцы", value: "data-table-expand" },
    ],
    items: [],
    search: "",
    editedIndex: -1,
    editedItem: {
      name_item: "",
      type_item: 0,
      light_item: false,
      price_item: 0,
      make_price_item: 0,
      mount_price_item: 0,
      location_item: 0,
      tech_item: 0,
    },
    defaultItem: {
      name_item: "",
      type_item: 0,
      light_item: false,
      price_item: 0,
      make_price_item: 0,
      mount_price_item: 0,
      location_item: 0,
      tech_item: 0,
    },
  }),

  components: {
    UploadFile,
    Side,
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Создать" : "Редактировать";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      axios.get("bill").then((response) => {
        this.items = response.data;
      });
    },

    editItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.items.splice(this.editedIndex, 1);
      axios
        .post("bill/delete", {
          item: this.editedItem,
        })
        .then((response) => {
          this.initialize();
        });
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.items[this.editedIndex], this.editedItem);
      } else {
        this.items.push(this.editedItem);
      }
      axios
        .post("bill/update", {
          item: this.editedItem,
        })
        .then((response) => {
          this.initialize();
        });
      this.close();
    },

    getPhotoLink(data) {
      console.log(data[0] == 0);
      console.log(data);
      if (data[0] == 0) {
        this.editedItem.photo_a_item = data[1];
      } else {
        this.editedItem.photo_b_item = data[1];
      }
    },
  },
};
</script>
