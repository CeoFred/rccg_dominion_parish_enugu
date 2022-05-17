const loginForm = document.getElementById('adminLoginForm');
const baseUrl = window.location.origin;

window.addEventListener('load', () => {
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(loginForm);
        const admin = {};
        formData.forEach((value, key) => {
            admin[key] = value;
        });
        loginAdmin(admin);
    });
});


function loginAdmin(admin){

    const errorDiv = document.getElementById('error');
    errorDiv.innerHTML = '';
    errorDiv.style.display = 'none';
    const submitButton = document.getElementById('submitButton');
    // submitButton.disabled = true;
    const url = `${baseUrl}/api/v1/church/admin/login.php`;
    console.log(baseUrl);
  // send request with jquery ajax
  $.ajax({
    url,
    type: 'POST',
    data: admin,
    success: (response) => {
        setTimeout(() => {
          window.location.href = `${baseUrl}`;
        }, 0);
    },
    error: (error) => {
      const error_object = error.responseJSON;
      
      if(error.status < 500){
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