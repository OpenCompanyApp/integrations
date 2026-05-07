<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Create a purchase record. Kit documents this as OAuth-only.
 */
class ConvertKitCreatePurchase extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_create_purchase';
    protected const TOOL_DESCRIPTION = 'Create a purchase record. Kit documents this as OAuth-only.';
    protected const METHOD = 'POST';
    protected const PATH = '/purchases';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'transaction_id',  1 => 'email_address',  2 => 'currency',  3 => 'products',  4 => 'total',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'transaction_id' =>   array (    'type' => 'string',    'description' => 'Body field: transaction id.',  ),  'email_address' =>   array (    'type' => 'string',    'description' => 'Body field: email address.',  ),  'currency' =>   array (    'type' => 'string',    'description' => 'Body field: currency.',  ),  'products' =>   array (    'type' => 'array',    'description' => 'Body field: products.',  ),  'total' =>   array (    'type' => 'string',    'description' => 'Body field: total.',  ),);
    protected const DYNAMIC_PATH = false;
}
