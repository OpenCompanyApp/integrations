<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Remove tags from subscribers in bulk. OAuth may be required by Kit.
 */
class ConvertKitBulkRemoveTagsFromSubscribers extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_bulk_remove_tags_from_subscribers';
    protected const TOOL_DESCRIPTION = 'Remove tags from subscribers in bulk. OAuth may be required by Kit.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/bulk/tags/subscribers';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'tag_ids',  1 => 'subscriber_ids',  2 => 'email_addresses',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'tag_ids' =>   array (    'type' => 'array',    'description' => 'Body field: tag ids.',  ),  'subscriber_ids' =>   array (    'type' => 'array',    'description' => 'Body field: subscriber ids.',  ),  'email_addresses' =>   array (    'type' => 'array',    'description' => 'Body field: email addresses.',  ),);
    protected const DYNAMIC_PATH = false;
}
