let form = document.querySelector('.login');
let errorsContainer = document.querySelector('.errors');

form.addEventListener('submit', (e)=> {
  e.preventDefault();
  let formData = new FormData(form);

  let req = new XMLHttpRequest();
  req.open('post', 'http://localhost:8000/api/login', true);
  req.send(formData);

  req.onreadystatechange = function() {
    if(req.readyState == 4 && req.status == 200) {
      let res = req.responseText;
      res = JSON.parse(res);
      let token = res.data.token;
      let user_id = res.data.user_id;
      document.cookie = 'user_id='+user_id;
      window.open(`http://localhost:8000/dashboard?api_token=${token}&id=${user_id}`, '_self');

    } else if(req.readyState == 4 && req.status == 401) {
      errorsContainer.innerHTML = '';
      errorsContainer.style.display = 'flex';
      let errors = req.responseText;
      errors = JSON.parse(errors);
      errors = errors.data.error;

      if(typeof(errors) == 'object') {
        errors.forEach(error => {
          errorsContainer.innerHTML += `<h4>${error}</h4>`;
        });
      } else {
        errorsContainer.innerHTML += `<h4>${errors}</h4>`;
      }
    }
  }
});