<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Create custom fields in bulk. OAuth may be required by Kit.
 */
class ConvertKitBulkCreateCustomFields extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_bulk_create_custom_fields';
    protected const TOOL_DESCRIPTION = 'Create custom fields in bulk. OAuth may be required by Kit.';
    protected const METHOD = 'POST';
    protected const PATH = '/bulk/custom_fields';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'custom_fields',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'custom_fields' =>   array (    'type' => 'string',    'description' => 'Body field: custom fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
