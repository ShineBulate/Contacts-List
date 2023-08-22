function validateForm(){
    const nameInput = document.getElementById("user-name");
    const phoneInput = document.getElementById("user-phone");
    phoneInput.focus();
    phoneInput.selectionStart = phoneInput.value.length;

    if(nameInput.value.length <3 || phoneInput.value.length < 10 ){
        nameInput.focus();
        document.getElementById("error-length").style.display = "block";
        setTimeout(() =>{
            document.getElementById("error-length").style.display = "none";

        },2000);
        return false;
    }
    const nameRegex = /^[а-яёА-ЯЁ\s]+$/;
    if(!nameRegex.test(nameInput.value)){
        nameInput.focus();
        document.getElementById("error-name").style.display = "block";

        setTimeout(() =>{
            document.getElementById("error-name").style.display = "none";
        },2000);
        return false;
    }

    const phoneRegex = /^[0-9\-\s]+$/;
    if(!phoneRegex.test(phoneInput.value)){
        document.getElementById("error-phone").style.display = "block";
        setTimeout(() =>{
            document.getElementById("error-phone").style.display = "none";
        },2000);
        phoneInput.focus();

        return false;
    }

    return true;
}
function sendData() {
    if(!validateForm()){
        return false;
    }
    const addContactForm = document.getElementById('addContactForm');
    const url = "../../../app/Controllers/ContactController/StoreController.php";
    const nameInput = document.getElementById("user-name").value;
    const phoneInput = document.getElementById("user-phone").value;
    const success = document.getElementById("modal-success");
    const result = document.getElementById("result");
    const data = {
        user_name: nameInput,
        user_phone: phoneInput
    };

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(responseData => {
            const resultDiv = document.getElementById("contact-data");
            resultDiv.innerHTML = '';
            responseData.forEach(function(contact){

                const contactHTML = `
                           <div id="contact-name" class="contact-id">${contact.user_name}<button class="cross" onclick="delete_modal(${contact.id})"></button></div>
                            <p id="contact-phone" class="phone">${contact.user_phone}</p></br>
                    
        `;
                resultDiv.innerHTML += contactHTML;
                success.style.display = "block";
                result.innerHTML = "Контакт был успешно добавлен!";
                setTimeout(() =>{
                    success.style.display = "none";
                },2000);
                addContactForm.reset();
            })
        })
        .catch(error => {
            console.error("Ошибка при отправке данных", error);
        });
}

document.getElementById("addContactForm").addEventListener("submit", function(event) {
    event.preventDefault();
    sendData();

});
function delete_modal(contactId) {
    document.getElementById("delete-modal-block").style.display = "block";
    document.getElementById("delete-form").addEventListener("submit",function(event){
        event.preventDefault();
        Delete(contactId);

    })
}
function Delete(contactId){
    const url = "../../../app/Controllers/ContactController/DeleteController.php";
    const success = document.getElementById("modal-success");
    const result = document.getElementById("result");
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ contact_id: contactId })
    })
        .then(response => response.json())
        .then(responseData => {
            const resultDiv = document.getElementById("contact-data");
            resultDiv.innerHTML = '';
            if(responseData === null){
                resultDiv.innerHTML = `<span class='empty'>Пусто контактов нет!</span>`;
                document.getElementById("delete-modal-block").style.display = "none";
                success.style.display = "block";
                result.innerHTML = "Контакт успешно удален!";
                setTimeout(() =>{
                    success.style.display = "none";
                },2000);
            }
            responseData.forEach(function(contact){
                const contactHTML = `
                           <div id="contact-name" class="contact-id">${contact.user_name}<button class="cross" onclick="delete_modal(${contact.id})"></button></div>
                            <p id="contact-phone" class="phone">${contact.user_phone}</p></br>
                    
        `;
                resultDiv.innerHTML += contactHTML;
                document.getElementById("delete-modal-block").style.display = "none";
                success.style.display = "block";
                result.innerHTML = "Контакт успешно удален!";
                setTimeout(() =>{
                    success.style.display = "none";
                },2000);

            })
        })
        .catch(error => {
            console.error("Ошибка при удалении контакта:", error);
        });

}




