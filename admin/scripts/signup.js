const signUpForm = document.getElementById('adminSignupForm');
const baseUrl = window.location.origin;

window.addEventListener('load', () => {
    signUpForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(signUpForm);
        const admin = {};
        formData.forEach((value, key) => {
            admin[key] = value;
        });
        signUpAdmin(admin);
    });
});


function signUpAdmin(admin){

    const errorDiv = document.getElementById('error');
    const successDiv = document.getElementById('success');
    successDiv.innerHTML = ''
    errorDiv.innerHTML = '';
    errorDiv.style.display = 'none';
    const submitButton = document.getElementById('submitButton');
    submitButton.disabled = true;
    const url = `${baseUrl}/api/v1/church/admin/signup.php`;

  // send request with jquery ajax
  $.ajax({
    url,
    type: 'POST',
    data: admin,
    success: (response) => {
      if(response.status_code === 201){
        successDiv.style.display = 'block';
        successDiv.innerHTML = 'Account created successfully,please wait...';
        setTimeout(() => {
          window.location.href = `${baseUrl}/login`;
        }, 2500);
      }
    },
    error: (error) => {
      const error_object = error.responseJSON;
      
      if(error.status === 403){
        errorDiv.innerHTML = error_object.message;
        errorDiv.style.display = 'block';
      } else {
        errorDiv.innerHTML = 'Something went wrong, try again';
        errorDiv.style.display = 'block';
      }
      submitButton.disabled = false;
    }
  });

}