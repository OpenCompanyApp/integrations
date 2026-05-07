<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve integration information.
 */
class AircallGetIntegration extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_integration';
    protected const TOOL_DESCRIPTION = 'Retrieve integration information.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/integration';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
