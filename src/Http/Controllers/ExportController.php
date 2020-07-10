<?php namespace professionalweb\IntegrationHub\IntegrationHubAdvCake\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use professionalweb\IntegrationHub\IntegrationHubAdvCake\Interfaces\Services\Generator;

/**
 * Controller to export data
 * @package professionalweb\IntegrationHub\IntegrationHubAdvCake\Http\Controllers
 */
class ExportController extends Controller
{
    public function index(Request $request, Generator $generator)
    {
        return response()->file(
            $generator->generate($request->get('from'), $request->get('to'))
        );
    }
}