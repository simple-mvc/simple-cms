<?php

namespace Simple\App\Controllers;

use Simple\Core\App;
use Simple\Core\Flash;

class PostsController extends Controller
{
  /**
   * GET /posts
   * Show all the posts
   *
   * @return mixed
   * @throws \Exception
   */
  public function index()
  {

    $posts = App::get('database')->selectAllPublished('posts');
    $title = 'posts';

    return view('posts.index', compact('title', 'posts'));
  }

  /**
   * GET /posts/{id}
   * Show a given post
   *
   * @param $id
   * @return mixed
   * @throws \Exception
   */
  public function show($id)
  {
    $post = App::get('database')->select('posts', $id);
    if ($post) {
      $title = 'Show post';
      return view('posts.show', compact('title', 'post'));
    }

    return view('pages.error');
  }

  public function create()
  {
    // Check if the user is already logged in
    if ((isset($_SESSION['username']) && isset($_SESSION['password']))
      && ($_SESSION['username'] === App::get('config')['admin']['username'])
      && (($_SESSION['password'] === App::get('config')['admin']['password'])))
    {

      $title = 'New Post';
      return view('posts.create', compact('title'));

    }
    // If not ask for credentials
    else
    {
      $title = 'Connexion';
      return view('admin.login', compact('title'));
    }
  }

  /**
   * POST /posts
   * Store a post into the database
   *
   * @throws \Exception
   */
  public function store()
  {

    $title = $_POST['title'];
    $content = $_POST['content'];

    $errors = $this->validate([
      'title' => $title,
      'content' => $content]
    );

    if (count($errors)) {

      $_SESSION['errors'] = $errors;

      Flash::message('alert', 'There are errors in the form.');

      return redirect('posts/create');

    } else {

      App::get('database')->insert('posts', [
        'title' => clean($title),
        'content' => clean($content)
      ]);

      Flash::message('success', 'Post successfully created.');

      return redirect('admin-posts');
    }
  }

  /**
   * GET /posts/{id}/edit
   * Show a form to edit a given post
   *
   * @param $id
   * @return mixed
   * @throws \Exception
   */
  public function edit($id)
  {
    // Check if the user is already logged in
    if ((isset($_SESSION['username']) && isset($_SESSION['password']))
        && ($_SESSION['username'] === App::get('config')['admin']['username'])
        && (($_SESSION['password'] === App::get('config')['admin']['password'])))
    {

      $post = App::get('database')->select('posts', $id);
      $title = 'Edit';
      return view('posts.edit', compact('title', 'post'));

    }
    // If not ask for credentials
    else
    {
      $title = 'Connexion';
      return view('admin.login', compact('title'));
    }
  }

  public function update($id)
  {

    $title = $_POST['title'];
    $content = $_POST['content'];

    $errors = $this->validate([
        'title' => $title,
        'content' => $content]
    );

    if (count($errors)) {

      $_SESSION['errors'] = $errors;

      Flash::message('alert', 'There are errors in the form.');

      return redirect("posts/{$id}/edit");

    } else {

      App::get('database')
        ->update('posts', [
          'title' => clean($_POST['title']),
          'content' => clean($_POST['content'])
        ], $id);

      Flash::message('success', 'Post successfully updated.');

      return redirect('admin-posts');

    }
  }

  /**
   * DELETE /posts/{id}
   * Delete a given post
   *
   * @param $id
   * @throws \Exception
   */
  public function destroy($id)
  {
    App::get('database')->delete('posts', $id);

    Flash::message('success', 'Post successfully deleted.');

    return redirect('admin-posts');
  }

  public function publish($id)
  {

    App::get('database')->publish('posts', $id);

    Flash::message('success', 'Post successfully published.');

    return redirect('admin-posts');

  }

  public function unpublish($id)
  {

    App::get('database')->unpublish('posts', $id);

    Flash::message('success', 'Post successfully unpublished.');

    return redirect('admin-posts');

  }

}
