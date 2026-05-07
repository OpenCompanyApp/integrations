<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Update a tag name.
 */
class ConvertKitUpdateTag extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_update_tag';
    protected const TOOL_DESCRIPTION = 'Update a tag name.';
    protected const METHOD = 'PUT';
    protected const PATH = '/tags/{id}';
    protected const PATH_KEYS = array (  0 => 'id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'name',);
    protected const PARAMETERS = array (  'id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),);
    protected const DYNAMIC_PATH = false;
}
