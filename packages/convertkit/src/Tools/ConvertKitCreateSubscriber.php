<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Create or upsert a subscriber.
 */
class ConvertKitCreateSubscriber extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_create_subscriber';
    protected const TOOL_DESCRIPTION = 'Create or upsert a subscriber.';
    protected const METHOD = 'POST';
    protected const PATH = '/subscribers';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'email_address',  1 => 'first_name',  2 => 'state',  3 => 'fields',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'email_address' =>   array (    'type' => 'string',    'description' => 'Body field: email address.',  ),  'first_name' =>   array (    'type' => 'string',    'description' => 'Body field: first name.',  ),  'state' =>   array (    'type' => 'string',    'description' => 'Body field: state.',  ),  'fields' =>   array (    'type' => 'array',    'description' => 'Body field: fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
