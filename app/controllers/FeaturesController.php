<?php

namespace Mvc\App\Controllers;

use Mvc\Core\App;

class FeaturesController
{
  public function index()
  {
    $features = App::get('database')->selectAll('features');
    $title = 'Features';
    return view('features.index', compact('title', 'features'));
  }

  public function show($id)
  {
    $feature = App::get('database')->select('features', $id);
    if ($feature) {
      $title = 'Show feature';
      return view('features.show', compact('title', 'feature'));
    }
    return view('pages.error');
  }

  public function store()
  {
    App::get('database')->insert('features', [
      'title' => $_POST['title'],
      'description' => $_POST['description']
    ]);

    return redirect('admin');
  }

  public function destroy($id)
  {
    App::get('database')->destroy('features', $id);

    return redirect('admin');
  }

}