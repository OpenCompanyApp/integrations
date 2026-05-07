<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Create a custom field.
 */
class ConvertKitCreateCustomField extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_create_custom_field';
    protected const TOOL_DESCRIPTION = 'Create a custom field.';
    protected const METHOD = 'POST';
    protected const PATH = '/custom_fields';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'label',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'label' =>   array (    'type' => 'string',    'description' => 'Body field: label.',  ),);
    protected const DYNAMIC_PATH = false;
}
