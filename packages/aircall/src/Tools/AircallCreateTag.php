<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Create a tag.
 */
class AircallCreateTag extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_create_tag';
    protected const TOOL_DESCRIPTION = 'Create a tag.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/tags';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'name',  1 => 'color',  2 => 'description',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),  'color' =>   array (    'type' => 'string',    'description' => 'Body field: color.',  ),  'description' =>   array (    'type' => 'string',    'description' => 'Body field: description.',  ),);
    protected const DYNAMIC_PATH = false;
}
