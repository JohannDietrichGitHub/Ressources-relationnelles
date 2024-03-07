<?php namespace App\Middleware;

namespace App\Middleware;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
$session = \Config\Services::session();

class AuthMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if (!isset($_SESSION['user_id'])) {
            return redirect()->to('/connexion')->with('error', 'Vous devez vous connecter pour accéder à cette page.');
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Actions après le traitement de la requête
        // Par exemple, logging ou nettoyage des données de sortie
        // Cette méthode est facultative et peut être laissée vide si vous n'avez rien à faire après le traitement de la requête.
    }
}