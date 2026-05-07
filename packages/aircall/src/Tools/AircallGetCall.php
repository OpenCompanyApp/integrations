<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve details of a specific call.
 */
class AircallGetCall extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_call';
    protected const TOOL_DESCRIPTION = 'Retrieve details of a specific call.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/calls/{call_id}';
    protected const PATH_KEYS = array (  0 => 'call_id',);
    protected const QUERY_KEYS = array (  0 => 'fetch_contact',  1 => 'fetch_short_urls',  2 => 'fetch_call_timeline',  3 => 'fetch_ivrs',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'call_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for call id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'fetch_contact' =>   array (    'type' => 'string',    'description' => 'Query parameter: fetch_contact.',  ),  'fetch_short_urls' =>   array (    'type' => 'string',    'description' => 'Query parameter: fetch_short_urls.',  ),  'fetch_call_timeline' =>   array (    'type' => 'string',    'description' => 'Query parameter: fetch_call_timeline.',  ),  'fetch_ivrs' =>   array (    'type' => 'string',    'description' => 'Query parameter: fetch_ivrs.',  ),);
    protected const DYNAMIC_PATH = false;
}
