<?php require_once('includes/header.php'); ?>
        <section id="test-section-id" class="usa-section">
            <div class="grid-container">
        <form class="usa-form">
            <fieldset class="usa-fieldset">
              <legend class="usa-legend usa-legend--large">ADE</legend>
              <label class="usa-label" for="email">User ID</label>
              <input
                class="usa-input"
                id="email"
                name="email"
                type="email"
                autocapitalize="off"
                autocorrect="off"
                required
              />
              <label class="usa-label" for="password-sign-in">Password</label>
              <input
                class="usa-input"
                id="password-sign-in"
                name="password"
                type="password"
                required
              />
              <button
                title=""
                type="button"
                class="usa-show-password"
                aria-controls=""
                data-show-text="Show password"
                data-hide-text="Hide password"
              >
                Show password
              </button>
              <input class="usa-button" type="submit" value="Sign in" />
              <p>
                <a href="javascript:void()" title="Forgot password">Forgot password?</a>
              </p>
            </fieldset>
          </form>
        </div>
    </section>
<?php require_once('includes/footer.php'); ?>