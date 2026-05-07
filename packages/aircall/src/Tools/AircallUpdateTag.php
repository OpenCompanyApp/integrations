<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Update a tag.
 */
class AircallUpdateTag extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_update_tag';
    protected const TOOL_DESCRIPTION = 'Update a tag.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/tags/{tag_id}';
    protected const PATH_KEYS = array (  0 => 'tag_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'name',  1 => 'color',  2 => 'description',);
    protected const PARAMETERS = array (  'tag_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for tag id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),  'color' =>   array (    'type' => 'string',    'description' => 'Body field: color.',  ),  'description' =>   array (    'type' => 'string',    'description' => 'Body field: description.',  ),);
    protected const DYNAMIC_PATH = false;
}
