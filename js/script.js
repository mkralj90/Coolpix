
/*register form validation*/


function CustomValidation(){
    this.invalidities = [];

}

CustomValidation.prototype = {
    addInvalidity: function (message){

        this.invalidities.push(message);
    },
    getInvalidities: function (){
        return  this.invalidities.join('. \n');
    },
    checkValidity: function (input){

        if(input.value.length < 3) {
            this.addInvalidity('this input needs to be at least 3 characters long !!');

            var element = document.querySelector('label[for="username1"] li:nth-child(1)');

            element.classList.add('invalid');
            element.classList.remove('valid');
        }else {

            var element = document.querySelector('label[for="username1"] li:nth-child(1)');

            element.classList.remove('invalid');
            element.classList.add('valid');

        }

        if (input.value.match(/[^a-zA-Z0-9]/g)){

            this.addInvalidity('Only letters and numbers are allowed !!!');
            var element = document.querySelector('label[for="username1"] li:nth-child(2)');

            element.classList.add('invalid');
            element.classList.remove('valid');
        }else {
            var element = document.querySelector('label[for="username1"] li:nth-child(2)');

            element.classList.remove('invalid');
            element.classList.add('valid');

        }

    }
};

var usernameInput = document.getElementById('username1');

usernameInput.CustomValidation = new CustomValidation();

usernameInput.addEventListener('keyup', function (){

    usernameInput.CustomValidation.checkValidity(this);

})