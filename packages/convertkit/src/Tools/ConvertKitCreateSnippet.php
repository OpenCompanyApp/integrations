<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Create a snippet.
 */
class ConvertKitCreateSnippet extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_create_snippet';
    protected const TOOL_DESCRIPTION = 'Create a snippet.';
    protected const METHOD = 'POST';
    protected const PATH = '/snippets';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'name',  1 => 'content',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'name' =>   array (    'type' => 'string',    'description' => 'Body field: name.',  ),  'content' =>   array (    'type' => 'string',    'description' => 'Body field: content.',  ),);
    protected const DYNAMIC_PATH = false;
}
