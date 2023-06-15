
function login() {

    const inputs = document.querySelectorAll('#grok_form_login input');
    let data = {};
    inputs.forEach(input => {
      if(input.type!=='submit') {
        data[input.name] = input.value;
      }
    });

    //const api_url = 'https://nefsctest.nmfs.local/grok/html/Backend/public/index.php/api';
    let base_url = '<?php echo base_url(); ?>';
        base_url = base_url.replace('ProjectOnePHP', 'Backend');

    fetch(base_url + '/index.php/api/auth', {
      method: 'POST',
      mode: 'cors',
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(
        result => alert(JSON.stringify(result, null, 2))
        /*
        if(result.authenticated) {
            location.reload();
        }else {
            alert('authentication failure');
        }
        */
    )

}
