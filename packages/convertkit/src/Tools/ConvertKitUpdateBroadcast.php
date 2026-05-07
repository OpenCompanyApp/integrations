<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Update a broadcast draft or schedule.
 */
class ConvertKitUpdateBroadcast extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_update_broadcast';
    protected const TOOL_DESCRIPTION = 'Update a broadcast draft or schedule.';
    protected const METHOD = 'PUT';
    protected const PATH = '/broadcasts/{id}';
    protected const PATH_KEYS = array (  0 => 'id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'content',  1 => 'description',  2 => 'public',  3 => 'published_at',  4 => 'preview_text',  5 => 'subject',  6 => 'send_at',  7 => 'subscriber_filter',  8 => 'email_template_id',  9 => 'email_address',  10 => 'thumbnail_alt',  11 => 'thumbnail_url',);
    protected const PARAMETERS = array (  'id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'content' =>   array (    'type' => 'string',    'description' => 'Body field: content.',  ),  'description' =>   array (    'type' => 'string',    'description' => 'Body field: description.',  ),  'public' =>   array (    'type' => 'string',    'description' => 'Body field: public.',  ),  'published_at' =>   array (    'type' => 'string',    'description' => 'Body field: published at.',  ),  'preview_text' =>   array (    'type' => 'string',    'description' => 'Body field: preview text.',  ),  'subject' =>   array (    'type' => 'string',    'description' => 'Body field: subject.',  ),  'send_at' =>   array (    'type' => 'string',    'description' => 'Body field: send at.',  ),  'subscriber_filter' =>   array (    'type' => 'array',    'description' => 'Body field: subscriber filter.',  ),  'email_template_id' =>   array (    'type' => 'string',    'description' => 'Body field: email template id.',  ),  'email_address' =>   array (    'type' => 'string',    'description' => 'Body field: email address.',  ),  'thumbnail_alt' =>   array (    'type' => 'string',    'description' => 'Body field: thumbnail alt.',  ),  'thumbnail_url' =>   array (    'type' => 'string',    'description' => 'Body field: thumbnail url.',  ),);
    protected const DYNAMIC_PATH = false;
}
