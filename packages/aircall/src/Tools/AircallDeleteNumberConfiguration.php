<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Delete number configuration for public API messaging.
 */
class AircallDeleteNumberConfiguration extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_delete_number_configuration';
    protected const TOOL_DESCRIPTION = 'Delete number configuration for public API messaging.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/numbers/{number_id}/configuration';
    protected const PATH_KEYS = array (  0 => 'number_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'number_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for number id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
