<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Get a snippet by ID.
 */
class ConvertKitGetSnippet extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_get_snippet';
    protected const TOOL_DESCRIPTION = 'Get a snippet by ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/snippets/{id}';
    protected const PATH_KEYS = array (  0 => 'id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
