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
            <v-text-field
                v-for="(photoUrls, index) in form.photosUrls"
                v-model="form.photosUrls[index]"
                label="Url zdjęcia"
                ></v-text-field>
            
            <div v-for="(tag, index) in form.tags">
                <v-text-field
                    v-model="form.tags[index].id"
                    label="Id tagu"
                    ></v-text-field>
                <v-text-field
                    v-model="form.tags[index].name"
                    label="Nazwa tagu"
                    ></v-text-field>
            </div>
            
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

    const form = ref({ id: 1, name: '', category: { id: 0, name: '' }, photosUrls: [], tags: [], status: '' });
    

    const rules = [
        value => {
            if (value) return true

            return 'Wprowadź wartość'
        },
    ];

    async function submit () {
    if (form.value.id > 0) {
        apiPetStore.edit(form);
    } else {
        apiPetStore.add(form);
    }
    }

    function get() {
        apiPetStore.get(form.value.id, form);
    }

    function remove() {
        apiPetStore.delete(form.value.id);
    }
  
    get();
  
</script>