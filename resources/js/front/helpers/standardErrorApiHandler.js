export async function standardErrorApiHandler(error, store) {
    
    if (error.response?.status === 400) {
        store.state.notify({
            type: 'error',
            title: 'Błąd',
            text: error.response.data.message,
        });
    } else if (error.response?.status === 422) {
        store.state.notify({
            type: 'error',
            title: 'Błąd',
            text: error.response.data.message,
        });
    } else {
        console.error(error);
        store.state.notify({
            type: 'error',
            title: 'Wystąpił błąd',
            text: 'Administrator został powiadomiony. Spróbuj ponownie później.',
        })
    }
}