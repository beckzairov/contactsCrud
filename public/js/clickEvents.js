const parentEmail = document.getElementById("parentEmail")
const parentPhone = document.getElementById("parentPhone")
const parentContact = document.getElementById("parentContact")

function getEmailClick(){
    document.querySelectorAll('.editEmail')
    .forEach((el, i) => 
        {
            el.addEventListener('click', 
                ()=>{
                        parentEmail.getElementsByClassName("text-l")[i].getElementsByClassName("editEmail")[0].remove()
                        parentEmail.getElementsByClassName("text-l")[i].getElementsByTagName("form")[0].classList.remove("hidden")
                    }
                )
        }
    );
}

function getPhoneClick(){
    document.querySelectorAll('.editPhone')
    .forEach((el, i) => 
        {
            el.addEventListener('click', 
                ()=>{
                        parentPhone.getElementsByClassName("text-l")[i].getElementsByClassName("editPhone")[0].remove()
                        parentPhone.getElementsByClassName("text-l")[i].getElementsByTagName("form")[0].classList.remove("hidden")
                    }
                )
        }
    );
}

function getContactClick(){
    document.querySelectorAll('.editContact')
    .forEach((el, i) => 
        {
            el.addEventListener('click', 
                ()=>{
                        parentContact.getElementsByClassName("text-l")[i].getElementsByClassName("editContact")[0].remove()
                        parentContact.getElementsByClassName("text-l")[i].getElementsByTagName("form")[0].classList.remove("hidden")
                    }
                )
        }
    );
}

