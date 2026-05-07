<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Bulk update subscriber custom field values. OAuth may be required by Kit.
 */
class ConvertKitBulkUpdateSubscriberCustomFields extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_bulk_update_subscriber_custom_fields';
    protected const TOOL_DESCRIPTION = 'Bulk update subscriber custom field values. OAuth may be required by Kit.';
    protected const METHOD = 'POST';
    protected const PATH = '/bulk/custom_fields/subscribers';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'subscribers',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'subscribers' =>   array (    'type' => 'array',    'description' => 'Body field: subscribers.',  ),);
    protected const DYNAMIC_PATH = false;
}
