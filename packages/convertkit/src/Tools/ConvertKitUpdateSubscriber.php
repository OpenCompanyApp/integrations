<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Update subscriber profile and custom fields.
 */
class ConvertKitUpdateSubscriber extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_update_subscriber';
    protected const TOOL_DESCRIPTION = 'Update subscriber profile and custom fields.';
    protected const METHOD = 'PUT';
    protected const PATH = '/subscribers/{id}';
    protected const PATH_KEYS = array (  0 => 'id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'email_address',  1 => 'first_name',  2 => 'state',  3 => 'fields',);
    protected const PARAMETERS = array (  'id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'email_address' =>   array (    'type' => 'string',    'description' => 'Body field: email address.',  ),  'first_name' =>   array (    'type' => 'string',    'description' => 'Body field: first name.',  ),  'state' =>   array (    'type' => 'string',    'description' => 'Body field: state.',  ),  'fields' =>   array (    'type' => 'array',    'description' => 'Body field: fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
