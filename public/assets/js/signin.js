let form = document.querySelector('.signin');
let errorsContainer = document.querySelector('.errors');

form.addEventListener('submit', (e)=> {
  e.preventDefault();
  let formData = new FormData(form);

  let req = new XMLHttpRequest();
  req.open('post', 'http://localhost:8000/api/signin', true);
  req.send(formData);

  req.onreadystatechange = function(res) {
    if(req.readyState == 4 && req.status == 200) {
      window.open('http://localhost:8000/login', '_self');
    } else if(req.readyState == 4 && req.status == 401) {
      errorsContainer.innerHTML = '';
      errorsContainer.style.display = 'flex';
      let errors = req.responseText;
      errors = JSON.parse(errors);
      errors = errors.data.error;

      errors.forEach(error => {
        errorsContainer.innerHTML += `<h4>${error}</h4>`;
      });
    }
  }
});