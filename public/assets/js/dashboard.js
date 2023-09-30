let voteBtns = document.querySelectorAll('.vote-btn');
let voteElm = document.querySelector('.vote');
let closeVote = document.querySelector('.vote .close');
let voteForm = document.querySelector('.voting');
let searchBox = document.querySelector('.search-box');
let searchResult = document.querySelector('.search-result');
let gameId;
let team1Id;
let team2Id;
voteBtns.forEach(btn=> {
  btn.addEventListener('click', ()=> {
    voteElm.style.display = 'flex';
    gameId = btn.getAttribute('data-id');
    team1Id = btn.getAttribute('data-team1');
    team2Id = btn.getAttribute('data-team2');
  });
});

closeVote.addEventListener('click', ()=> {
  voteElm.style.display = 'none';
});


// IF USER SEND REQUEST FOR VOTING
voteForm.addEventListener('submit', e=> {
  e.preventDefault();
  let formdata = new FormData(voteForm);
  formdata.append('game_id', gameId);
  let req = new XMLHttpRequest();
  req.open('post', 'http://localhost:8000/vote', true);
  req.send(formdata);
  
  location.reload();
});


// SEARCH-BOX CONNECT TO DATABASE WITH AJAX
searchBox.addEventListener('keyup', e=> {
  if(searchBox.value == '') {
    return searchResult.classList.remove('active');
  }
  searchResult.classList.add('active');

  let req = new XMLHttpRequest();
  req.open('get', `http://localhost:8000/search`, true);
  req.send();

  req.onreadystatechange = function() {
    if(req.readyState == 4 && req.status == 200) {
      searchResult.innerHTML = '';
      let res = JSON.parse(req.response);
      res.users.forEach(user=> {
        if(user.name.indexOf(searchBox.value) >= 0) {
          searchResult.innerHTML += `
            <li>
              <div class="avatar">
                <img src="assets/images/${user.avatar}" >
              </div>
              <div>
                <h4>${user.name}</h4>
                <h5>${user.email}</h5>
              </div>
            </li>
          `;
        }
      });
    }
  }
});