<?php
namespace Modules\Weblog;

use Models\Post;
use Sel\Controller\Action;
use ActiveRecord\RecordNotFound;
use Sel\Exception\PageNotFound;
use Sel\Exception\ModelInvalid;

/**
 * PostController
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class PostsController extends Action
{
    public function index_action()
    {
        $this->view->posts = Post::all();
    }

    public function add_action()
    {
        $this->render('edit');
    }

    public function edit_action()
    {
        try
        {
            $this->view->post = Post::find($this->get_param('id', 0));
        }
        catch( RecordNotFound $e )
        {
            throw new PageNotFound('Nie znaleziono postu o podanym id');
        }   
    }

    public function save_action()
    {
        if( ! $this->get_request()->is_post() )
        {
            throw new Sel\Exception('Akcja tylko dla zapytań post', 404);
        }

        $data = $this->get_param('post');
        $post = Post::find_or_create_by_id($data['id']);

        if( $post->update_attributes($data) )
        {
            $this->redirect('index');
        }
        else
        {
            $this->view->post = $post;
            $this->render('edit');
        }
    }

    public function remove_action()
    {
        if( 0 == Post::delete_all(array('conditions' => array('id' => $this->get_param('id', 0)))) )
        {
            throw new PageNotFound('Nie można usunąć rekordu o podanym id');
        }
        $this->go_back();
    }
    
}