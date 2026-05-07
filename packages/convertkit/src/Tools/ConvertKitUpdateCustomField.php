<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Update a custom field label.
 */
class ConvertKitUpdateCustomField extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_update_custom_field';
    protected const TOOL_DESCRIPTION = 'Update a custom field label.';
    protected const METHOD = 'PUT';
    protected const PATH = '/custom_fields/{id}';
    protected const PATH_KEYS = array (  0 => 'id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'label',);
    protected const PARAMETERS = array (  'id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'label' =>   array (    'type' => 'string',    'description' => 'Body field: label.',  ),);
    protected const DYNAMIC_PATH = false;
}
