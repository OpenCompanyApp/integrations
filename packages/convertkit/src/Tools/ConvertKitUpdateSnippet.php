<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Update a snippet.
 */
class ConvertKitUpdateSnippet extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_update_snippet';
    protected const TOOL_DESCRIPTION = 'Update a snippet.';
    protected const METHOD = 'PUT';
    protected const PATH = '/snippets/{id}';
    protected const PATH_KEYS = array (  0 => 'id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'name',  1 => 'content',);
    protected const PARAMETERS = array (  'id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),  'content' =>   array (    'type' => 'string',    'description' => 'Body field: content.',  ),);
    protected const DYNAMIC_PATH = false;
}
