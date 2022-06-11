const contactForm = document.getElementById('customer-contact-form');
const propertyTitle = document.getElementById('poperty_title');
const mainContact = document.getElementById('main-contact-form');
const loginForm = document.getElementById('login-form');
const logOutBtn = document.getElementById('logout-btn');
const newAgencyForm = document.getElementById('new-agency-form');
const newAgentForm = document.getElementById('new_agent_form');
const addLodgeBtn = document.getElementById('add_property_submit');
const addLoddgeForm = document.getElementById('add-property');
const deletePropBtn = document.querySelectorAll('.delete_propBtn');

if(deletePropBtn) {
    
   deletePropBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            Swal.fire({ icon: "question", title: "Question", showCancelButton: true});
            document.querySelector('.swal2-confirm').addEventListener('click', () => {
               let form = new FormData();
               form.append('prop_code', btn.dataset.code);

               let xhr = new XMLHttpRequest();
               xhr.open('POST', '/delete-property', true);

               xhr.addEventListener('readystatechange', () => {

                   if(xhr.readyState === 4 && xhr.status === 200) {

                       if(JSON.parse(xhr.response)['status']) {

                        Swal.fire({icon: "success", title: "Property Deleted Successfully"});
                        document.querySelector('.swal2-confirm').addEventListener('click', () => {window.location.href = '/view-lodges'});
                        } 
                    }
               });

               xhr.send(form);

            });
        });
   });
}

if(newAgentForm) {

    document.querySelectorAll('.error').forEach((e) => {
        e.innerHTML = e.textContent = '';
    });
    newAgentForm.addEventListener('submit', (e) => {
        e.preventDefault();
        let agentForm = new FormData(newAgentForm);

        let token = document.querySelector('meta[name="token"]');
        if(token) {
            agentForm.append('token', token.getAttribute('content'));
        }

        let xhr = new XMLHttpRequest();
        xhr.open('POST', newAgentForm.getAttribute('action'), true);

        xhr.addEventListener('readystatechange', () => {
            if(xhr.readyState === 4) {
                console.log(xhr.response)
                // handleAgencyResponse(JSON.parse(xhr.response));
            }
        });
        xhr.send(agentForm);
    });
}

if(newAgencyForm) {

    document.querySelectorAll('.error').forEach((e) => {
        e.innerHTML = e.textContent = '';
    });
    newAgencyForm.addEventListener('submit', (e) => {
        e.preventDefault();
        let agencyForm = new FormData(newAgencyForm);

        let token = document.querySelector('meta[name="token"]');
        if(token) {
            agencyForm.append('token', token.getAttribute('content'));
        }

        let xhr = new XMLHttpRequest();
        xhr.open('POST', newAgencyForm.getAttribute('action'), true);

        xhr.addEventListener('readystatechange', () => {
            if(xhr.readyState === 4) {
                console.log(xhr.response)
                // handleAgencyResponse(JSON.parse(xhr.response));
            }
        });
        xhr.send(agencyForm);
    });
}

if(addLodgeBtn) {
    addLodgeBtn.addEventListener('click', (e) => {

        e.preventDefault()

        let xhr = new XMLHttpRequest();

        xhr.open('POST', '/add-property', true);

        let formData = new FormData(addLoddgeForm);
        let token = document.querySelector('meta[name="token"]');

        if(token) {
            formData.append('token', token.getAttribute('content'));
        }
        xhr.addEventListener('readystatechange', () => {
            if(xhr.readyState === 4 && xhr.status == 200) {
                // console.log(xhr.response)
                if(JSON.parse(xhr.response)['status']) {
                    Swal.fire({ icon: "success", title: "Success"});
                    document.querySelector('.swal2-confirm').addEventListener('click', () => window.location.href = '/user');
                }
                else {
                    let data = JSON.parse(xhr.response)['response'];

                    Object.entries(data).forEach(([key, value]) => {
                        document.querySelector(`#${key}`).textContent = value[0];
                    })
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong',
                        text: 'Check required input fields',
                      });
                }
            }
        });
        xhr.send(formData);
    });
}


if(logOutBtn) {
    logOutBtn.addEventListener('click', () => {
        let xhr = new XMLHttpRequest();

        xhr.open('POST', '/logout', true);

        let formData = new FormData();
        let token = document.querySelector('meta[name="token"]');
        if(token) {
            formData.append('token', token.getAttribute('content'));
        }
        xhr.addEventListener('readystatechange', () => {
            if(xhr.readyState === 4 && xhr.status == 200) {
                if(JSON.parse(xhr.response)['status']) {
                    window.location.href = '/';
                }
                else {

                }
            }
        });
        xhr.send(formData);
    });
}

if(loginForm) {
    loginForm.addEventListener('submit', (e) => {

        e.preventDefault();

        let formData = new FormData(loginForm);

        let token = document.querySelector('meta[name="token"]');
        if(token) {
            formData.append('token', token.getAttribute('content'));
        }
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/login', true);
    
        xhr.addEventListener('readystatechange', () => {
            if(xhr.readyState === 4) {
                console.log(xhr.response);
                if(JSON.parse(xhr.response)['status']) {
                    window.location.href = '/user';
                }
                else {
                    document.querySelector('.login-form-message').innerHTML = JSON.parse(xhr.response)['response'];
                }
            }
        });
    
        xhr.send(formData);
    });

    
}


if(mainContact) {
    mainContact.addEventListener('submit', (e) => {
    
        e.preventDefault();
        
        let formData = new FormData(mainContact);

        let token = document.querySelector('meta[name="token"]');
        if(token) {
            formData.append('token', token.getAttribute('content'));
        }
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/new-customer', true);
    
        xhr.addEventListener('readystatechange', () => {
            if(xhr.readyState === 4) {
                handleContactResponse(JSON.parse(xhr.response));
               
            }
        });
    
        xhr.send(formData);
    });

}


if(contactForm && propertyTitle) {
    contactForm.addEventListener('submit', (e) => {
    
        e.preventDefault();
    
        let formData = new FormData(contactForm);
        formData.append('prop_code', propertyTitle.dataset.code);

        let token = document.querySelector('meta[name="token"]');
        if(token) {
            formData.append('token', token.getAttribute('content'));
        }
    
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/new-customer', true);
    
        xhr.addEventListener('readystatechange', () => {
            if(xhr.readyState === 4) {
                console.log(xhr.response);
                handleContactResponse(JSON.parse(xhr.response));
            }
        });
    
        xhr.send(formData);
    });
}

function handleContactResponse(data) {

    const message = document.querySelector('.fom-messege');

    if(data['status'] == true) {
        message.classList.remove('error');
        message.classList.add('success');

        message.innerHTML = message.textContent = data['response'];
        setTimeout(() => {
                    window.location.href = '/';
                }, 5000);
    }

    if(data['status'] == false) {
        message.firstChild.innerHTML = message.textContent = data['response'];
    }

}

function handleAgencyResponse(data) {

    if(!data['status']) {
        Object.entries(data['response']).forEach(([key, value]) => {
            document.getElementById(key).innerHTML = value[0];
        });
    }
    else {

    }
}