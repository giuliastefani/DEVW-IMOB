<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        //verificar na sessão se o usuário está autenticado
        //e se possui um perfil válido!
        $session = service('session');
        $perfil = $session->get('perfil');

        //se não estiver logado, redireciona para login
        if (empty($perfil)) {
            return redirect()->to(base_url('login'));
        }

        //se foram passados argumentos (perfis permitidos), valida
        if (! empty($arguments)) {
            if (! is_array($arguments)) {
                $arguments = explode(',', (string) $arguments);
            }
            if (! in_array($perfil, $arguments)) {
            return redirect()->to(base_url('login'))->with('msg', 'Você não tem permissão para acessar esse recurso');
            }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
