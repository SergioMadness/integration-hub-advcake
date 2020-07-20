<?php namespace professionalweb\IntegrationHub\IntegrationHubAdvCake\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Services\Generator;

/**
 * Controller to export data
 * @package professionalweb\IntegrationHub\IntegrationHubAdvCake\Http\Controllers
 */
class ExportController extends Controller
{
    public function index(Request $request, Generator $generator)
    {
        $pathToFile = $generator->generate($request->get('from'), $request->get('to'));
        if (empty($pathToFile)) {
            throw new NotFoundHttpException();
        }

        return response()->file($pathToFile);
    }
}