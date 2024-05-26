<template>
    <v-sheet>
        <div>Dodaj tablice</div>
        <v-form @submit.prevent="submit()">
            <v-text-field
                v-model="form.id"
                label="Id"
                :autofocus="true"
                ></v-text-field>
            <v-btn
                @click="get()"
                :loading="store.getters.isLoading"
                type="button"
                color="green"
                >Pobierz rekord o wpisanym id</v-btn>
            <v-btn
                @click="remove()"
                :loading="store.getters.isLoading"
                type="button"
                color="red"
                >Usuń rekord o wpisanym id</v-btn>
            <v-text-field
                v-model="form.name"
                label="Nazwa"
                :rules="rules"
                ></v-text-field>
            <v-text-field
                v-model="form.category.id"
                label="Id kategorii"
                ></v-text-field>
            <v-text-field
                v-model="form.category.name"
                label="Nazwa kategorii"
                ></v-text-field>
            <div class="d-flex ga-2" v-for="(photoUrls, index) in form.photoUrls">
                <v-text-field
                    v-model="form.photoUrls[index]"
                    label="Url zdjęcia"
                    ></v-text-field>
                <v-btn 
                    :disabled="store.getters.isLoading"
                    @click="deletePhotoUrl(index)"
                    color="red"
                    class="ma-1"
                    >
                    <span class="mdi mdi-delete"></span>
                    <v-tooltip activator="parent" location="top" text="Usuń"></v-tooltip>
                </v-btn>
            </div>
            <div v-if="form.photoUrls.length === 0">Brak zdjęć</div>
            <v-btn
                :disabled="store.getters.isLoading"
                @click="addNewPhotoUrl()"
                color="green"
                class="ma-1"
              >
                Dodaj url zdjęcia
                <v-tooltip activator="parent" location="top" text="Dodaj"></v-tooltip>
            </v-btn>
            <div class="d-flex ga-2" v-for="(tag, index) in form.tags">
                <v-text-field
                    v-model="form.tags[index].id"
                    label="Id tagu"
                    ></v-text-field>
                <v-text-field
                    v-model="form.tags[index].name"
                    label="Nazwa tagu"
                    ></v-text-field>
                <v-btn 
                    :disabled="store.getters.isLoading"
                    @click="deleteTag(index)"
                    color="red"
                    class="ma-1"
                    >
                    <span class="mdi mdi-delete"></span>
                    <v-tooltip activator="parent" location="top" text="Usuń"></v-tooltip>
                </v-btn>
            </div>
            <div v-if="form.tags.length === 0">Brak tagów</div>
            <v-btn
                :disabled="store.getters.isLoading"
                @click="addNewTag()"
                color="green"
                class="ma-1"
              >
                Dodaj tag
                <v-tooltip activator="parent" location="top" text="Dodaj"></v-tooltip>
              </v-btn>
            <v-text-field
                v-model="form.status"
                label="Status"
                ></v-text-field>

            <v-btn
                :loading="store.getters.isLoading"
                type="submit"
                color="green"
                >Zapisz</v-btn>
        </v-form>
    </v-sheet>
</template>
    
<script setup>
    
    import { ref } from 'vue';
    import { useStore } from 'vuex';
    import { PetStore } from '../../helpers/apis/apiPetStore';
    
    const store = useStore();
    const apiPetStore = new PetStore(store);

    const form = ref({ id: 1, name: null, category: { id: null, name: null }, photoUrls: [], tags: [], status: null });
    

    const rules = [
        value => {
            if (value) return true

            return 'Wprowadź wartość'
        },
    ];

    async function submit () {
        
        const formValues = { value: { ...form.value }};

        if (formValues.value.category.id === null && formValues.value.category.name === null) {
            delete(formValues.value.category);
        }

        if (form.value.id > 0) {
            apiPetStore.edit(formValues);
        } else {
            apiPetStore.add(formValues);
        }
    }

    function get() {
        apiPetStore.get(form.value.id, form);
    }

    function remove() {
        apiPetStore.delete(form.value.id);
    }

    function addNewPhotoUrl() {
        form.value.photoUrls.push('');
    }

    function deletePhotoUrl(index) {
        form.value.photoUrls.splice(index, 1);
    }

    function addNewTag() {
        form.value.tags.push({ id: 1, name: '' });
    }

    function deleteTag(index) {
        form.value.tags.splice(index, 1);
    }
  
</script>