<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Bulk add subscribers to forms. OAuth may be required by Kit.
 */
class ConvertKitBulkAddSubscribersToForms extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_bulk_add_subscribers_to_forms';
    protected const TOOL_DESCRIPTION = 'Bulk add subscribers to forms. OAuth may be required by Kit.';
    protected const METHOD = 'POST';
    protected const PATH = '/bulk/forms/subscribers';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'form_ids',  1 => 'subscriber_ids',  2 => 'email_addresses',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'form_ids' =>   array (    'type' => 'array',    'description' => 'Body field: form ids.',  ),  'subscriber_ids' =>   array (    'type' => 'array',    'description' => 'Body field: subscriber ids.',  ),  'email_addresses' =>   array (    'type' => 'array',    'description' => 'Body field: email addresses.',  ),);
    protected const DYNAMIC_PATH = false;
}
