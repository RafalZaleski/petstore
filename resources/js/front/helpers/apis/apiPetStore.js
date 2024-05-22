import axios from 'axios';
import { standardErrorApiHandler } from '../standardErrorApiHandler.js';

export class PetStore {
    constructor(store) {
        this.store = store;
    }

    async get(id, form) {
        this.store.commit('startLoading');

        await axios.get('/pets/' + id)
            .then((response) => {
                if (response.data.code === 1) {
                    this.store.state.notify({
                        type: 'error',
                        title: 'Wystąpił błąd',
                        text: response.data.message,
                    })
                } else {
                    form.value = { ...response.data };
                }                
            })
            .catch((error) => standardErrorApiHandler(error, this.store));

        this.store.commit('stopLoading');
    }

    async add(form) {
        this.store.commit('startLoading');

        await axios.post('/pets', form.value)
            .then((response) => {
                form.value = { ...response.data };
                this.store.state.notify({
                    type: 'success',
                    title: "Utworzono produkt",
                });
            })
            .catch((error) => standardErrorApiHandler(error, this.store));

        this.store.commit('stopLoading');
    }

    async edit(form) {
        this.store.commit('startLoading');

        await axios.post('/pets/' + form.value.id, { ...form.value, _method: 'put'})
        .then((response) => {
            form.value = { ...response.data };
            this.store.state.notify({
                type: 'success',
                title: "Zmieniono produkt",
            });
        })
        .catch((error) => standardErrorApiHandler(error, this.store));

        this.store.commit('stopLoading');
    }

    async delete(id) {
        this.store.commit('startLoading');

        await axios.post('/pets/' + id, { _method: 'delete'})
        .then((response) => {
            this.store.state.notify({
                type: 'success',
                title: "Usunięto produkt",
            });
        })
        .catch((error) => standardErrorApiHandler(error, this.store));

        this.store.commit('stopLoading');
    }
}