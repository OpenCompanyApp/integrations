<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Create number configuration for public API messaging.
 */
class AircallCreateNumberConfiguration extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_create_number_configuration';
    protected const TOOL_DESCRIPTION = 'Create number configuration for public API messaging.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/numbers/{number_id}/configuration';
    protected const PATH_KEYS = array (  0 => 'number_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'configuration',);
    protected const PARAMETERS = array (  'number_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for number id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'configuration' =>   array (    'type' => 'array',    'description' => 'Body field: configuration.',  ),);
    protected const DYNAMIC_PATH = false;
}
