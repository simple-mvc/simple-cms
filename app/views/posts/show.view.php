<?php require __DIR__.'/../partials/head.php'; ?>

  <div class="grid-x align-center">
    <article class="small-10 medium-8 large-6">
      <h1 class="margin-top-2" style="line-height: 1"><?= $post->title; ?></h1>
      <p class="lead font-italic margin-bottom-2">
        <time>
          <?php
            $date = new DateTime($post->created_at);
            echo $date->format('M d, Y');
          ?>
        </time>
        by John Doe
      </p>
      <?php if($post->cover) : ?>
        <picture>
          <source media="(min-width: 768px)"
                  srcset="/img/<?= $post->cover; ?> 1x,
                          /img/lg-<?= $post->cover; ?> 2x">
          <img src="/img/sm-<?= $post->cover; ?>"
               srcset="/img/<?= $post->cover; ?> 2x"
               alt="" style="width: 100%">
        </picture>
      <?php endif; ?>
      <div class="margin-top-2"><?= $post->content; ?></div>
    </article>
  </div>

</main>

<footer class="text-center padding-top-3 padding-bottom-1">
  <p>© 2018 • This project is on <a href="https://github.com/simple-mvc/simple">GitHub</a></p>
</footer>
<?php require __DIR__ . '/../partials/scripts.php'; ?>
</body>
</html>