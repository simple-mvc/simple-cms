<?php require __DIR__.'/../admin/partials/head.php'; ?>

  <!-- CONTENT -->
  <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

    <a href="/admin-features"><i class="fas fa-long-arrow-alt-left"></i> Back</a>

    <h2 class="text-center">New Feature</h2>
    <hr>

    <?php require __DIR__ . '/../partials/message.php'; ?>

    <div class="grid-x align-center margin-top-2">
      <div class="small-8 medium-6">
        <?php require __DIR__ . '/../partials/errors.php'; ?>
        <form action="/features" method="POST" novalidate>
          <div data-abide-error class="callout alert-callout-border alert" style="display: none;">
            <p><i class="fi-alert"></i> There are some errors in your form.</p>
          </div>
          <label>Title&thinsp;*
            <input name="title" type="text" placeholder="Title of the feature" required pattern="^.{3,50}$" value="<?= isset($title) ? $title : ''; ?>">
            <span class="form-error">
                    Title is required and must contain between 3 and 50 characters.
                  </span>
          </label>
          <p class="help-text">Required. Between 3 and 50 characters.</p>
          <label>Description&thinsp;*
            <textarea name="description" placeholder="Description of the feature" rows="3" pattern="^.{3,255}$" required><?= isset($description) ? $description : ''; ?></textarea>
            <span class="form-error">
                    Description is required and must contain between 3 and 255 characters.
                  </span>
          </label>
          <p class="help-text">Required. Between 3 and 255 characters.</p>
          <input type="submit" class="button" value="Add a feature">
        </form>
      </div>
    </div>

  </div>

    <?php require __DIR__.'/../partials/scripts.php'; ?>
    <script>
        $('[data-app-dashboard-toggle-shrink]').on('click', function(e) {
            e.preventDefault();
            $(this).parents('.app-dashboard').toggleClass('shrink-medium').toggleClass('shrink-large');
        });
    </script>
  </body>
</html>


