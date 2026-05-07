<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Tag an existing subscriber by email address.
 */
class ConvertKitTagSubscriberByEmail extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_tag_subscriber_by_email';
    protected const TOOL_DESCRIPTION = 'Tag an existing subscriber by email address.';
    protected const METHOD = 'POST';
    protected const PATH = '/tags/{tag_id}/subscribers';
    protected const PATH_KEYS = array (  0 => 'tag_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'email_address',);
    protected const PARAMETERS = array (  'tag_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for tag id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'email_address' =>   array (    'type' => 'string',    'description' => 'Body field: email address.',  ),);
    protected const DYNAMIC_PATH = false;
}
