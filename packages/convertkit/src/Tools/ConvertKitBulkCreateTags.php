<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Create tags in bulk. OAuth may be required by Kit.
 */
class ConvertKitBulkCreateTags extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_bulk_create_tags';
    protected const TOOL_DESCRIPTION = 'Create tags in bulk. OAuth may be required by Kit.';
    protected const METHOD = 'POST';
    protected const PATH = '/bulk/tags';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'tags',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'tags' =>   array (    'type' => 'array',    'description' => 'Body field: tags.',  ),);
    protected const DYNAMIC_PATH = false;
}
