<?php

/**
 *
 * Fonction permettant de charger une vue depuis le contrôleur
 * Prend en paramètre le chemin de la vue depuis le dossier views
 * sous la forme 'dossier.vue' (ex.: 'pages.home')
 * Accepte en second argument optionnel un tableau de variables
 * qui seront passées à la vue
 *
 * @param $name
 * @param array $data
 * @return mixed
 */
function view($name, $data = []) {
  extract($data);
  $parts = explode('.', $name);
  return require "../app/views/{$parts[0]}/{$parts[1]}.view.php";
}

function redirect($path) {
  header("Location: /{$path}");
}