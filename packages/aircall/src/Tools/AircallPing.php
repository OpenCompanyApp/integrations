<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Test the Aircall API token with the ping endpoint.
 */
class AircallPing extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_ping';
    protected const TOOL_DESCRIPTION = 'Test the Aircall API token with the ping endpoint.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/ping';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
