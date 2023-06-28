
import { LoginCtrl } from "./controller/login"

const ctrl = new LoginCtrl()
const login = ctrl.login()

// setup the login component inside the #app element
document.querySelector('#app').innerHTML = `
<section id="test-section-id" class="usa-section">
<div class="grid-container">
  <div id="auth_fail_div">Failure message here</div>
  <form class="usa-form" id="grok_form_login" method="POST" action="${login}">
    <fieldset class="usa-fieldset">
      <legend class="usa-legend usa-legend--large">Atlas</legend>
      <label class="usa-label" for="email">User ID</label>
      <input class="usa-input" id="email" name="email" type="email" autocapitalize="off" autocorrect="off"
        placeholder="first.last@noaa.gov" required />
      <label class="usa-label" for="password-sign-in">Password</label>
      <input class="usa-input" id="password-sign-in" name="password" type="password" placeholder="Password"
        required />
      <button title="" type="button" class="usa-show-password" aria-controls="" data-show-text="Show password"
        data-hide-text="Hide password">Show password</button>
      <input class="usa-button" type="submit" value="Sign in" />
      <p>
        <a href="javascript:void()" title="Forgot password">Forgot password?</a>
      </p>
    </fieldset>
  </form>
</div>
</section>
`