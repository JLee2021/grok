
function login() {

    const inputs = document.querySelectorAll('#grok_form_login input');
    let data = {};
    inputs.forEach(input => {
      if(input.type!=='submit') {
        data[input.name] = input.value;
      }
    });

    //const api_url = 'https://nefsctest.nmfs.local/grok/html/Backend/public/index.php/api';
    const api_url = 'http://127.0.0.1:8080/grok/Backend/public/index.php/api';

    fetch(api_url + '/auth', {
      method: 'POST',
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(
        result => alert(JSON.stringify(result, null, 2))
    )

}
