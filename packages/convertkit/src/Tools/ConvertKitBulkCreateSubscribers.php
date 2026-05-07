<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Create subscribers in bulk. OAuth may be required by Kit.
 */
class ConvertKitBulkCreateSubscribers extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_bulk_create_subscribers';
    protected const TOOL_DESCRIPTION = 'Create subscribers in bulk. OAuth may be required by Kit.';
    protected const METHOD = 'POST';
    protected const PATH = '/bulk/subscribers';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'subscribers',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'subscribers' =>   array (    'type' => 'array',    'description' => 'Body field: subscribers.',  ),);
    protected const DYNAMIC_PATH = false;
}
