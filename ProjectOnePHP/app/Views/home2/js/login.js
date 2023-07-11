
function login() {

    const inputs = document.querySelectorAll('#grok_form_login input');
    let data = {};
    inputs.forEach(input => {
      if(input.type!=='submit') {
        data[input.name] = input.value;
      }
    });

    //let base_url = '<?php echo base_url(); ?>';
    let base_url = 'http://127.0.0.1:8080/grok/ProjectOnePHP/public';

    let headers = {"Content-type": "application/json;charset=UTF-8"};
    fetch(base_url + '/index.php/auth', {
      method: 'POST',
      //headers: headers,
      mode: 'same-origin',
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then( result => gotToHere(result))
    .catch(err => console.log('Request Failed', err)); // Catch errors

}

function gotToHere(json) {
      if(json.authenticated) {
        //location.reload();
        alert('authentication success');
    }else {
        alert('authentication failure');
    }
}
