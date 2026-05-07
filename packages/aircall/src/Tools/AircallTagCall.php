<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Apply tags to a call.
 */
class AircallTagCall extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_tag_call';
    protected const TOOL_DESCRIPTION = 'Apply tags to a call.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/calls/{call_id}/tags';
    protected const PATH_KEYS = array (  0 => 'call_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'tags',);
    protected const PARAMETERS = array (  'call_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for call id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'tags' =>   array (    'type' => 'array',    'description' => 'Body field: tags.',  ),);
    protected const DYNAMIC_PATH = false;
}
