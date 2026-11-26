
function step1() {
    const name = document.getElementById('name').value;
    const url = document.getElementById('step1-button').dataset.url;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },  
        body: JSON.stringify({ name }),
    }).then(async (response) => {
        const data = await response.json();
        if (!response.ok) {
            throw data;
        }
        return data;
    }).then((data) => {
        window.location.href = data.next;
    }).catch((error) => {
        console.error('Error:', error);
    });
}

function step2() {
    const email = document.getElementById('email').value;
    const url = document.getElementById('step2-button').dataset.url;
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ email }),
    }).then(async (response) => {
        const data = await response.json();
        if (!response.ok) {
            throw data;
        }
        return data;
    }).then((data) => {
        window.location.href = data.next;
    }).catch((error) => {
        console.error('Error:', error);
    });
}

function step3() {
    const acceptTerms = document.getElementById('accept_terms').checked;
    const url = document.getElementById('step3-button').dataset.url;
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ accept_terms: acceptTerms }),
    }).then(async (response) => {   
        const data = await response.json();
        if (!response.ok) {
            throw data;
        }
        return data;
    }).then((data) => {
        window.location.href = data.next;
    }).catch((error) => {
        console.error('Error:', error);
    });
}

window.step1 = step1;
window.step2 = step2;
window.step3 = step3;
