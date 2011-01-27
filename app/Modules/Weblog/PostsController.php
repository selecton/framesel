<?php
namespace Modules\Weblog;
use Modules\Weblog\AbstractController;
use Models\Post;
use ActiveRecord\RecordNotFound;
use Sel\Exception\PageNotFound;
use Sel\Exception\ModelInvalid;

/**
 * PostController
 *
 * @author Szymon Wygnański
 * @license http://creativecommons.org/licenses/by/3.0/pl/
 */
class PostsController extends AbstractController
{
    public function indexAction()
    {
        $this->_view->posts = Post::all();
    }

    public function addAction()
    {
        $this->render('edit');
    }

    public function editAction()
    {
        try
        {
            $this->_view->post = Post::find($this->getParam('id', 0));
        }
        catch( RecordNotFound $e )
        {
            throw new PageNotFound('Nie znaleziono postu o podanym id');
        }   
    }

    public function saveAction()
    {
        if( ! $this->getRequest()->isPost() )
        {
            throw new Sel\Exception('Akcja tylko dla zapytań post', 404);
        }

        $data = $this->getParam('post');
        $blogPost = Post::find_or_create_by_id($data['id']);

        if( $blogPost->update_attributes($data) )
        {
            $this->_redirect('index');
        }
        else
        {
            $this->_view->post = $blogPost;
            $this->render('edit');
        }
        
        
    }
}