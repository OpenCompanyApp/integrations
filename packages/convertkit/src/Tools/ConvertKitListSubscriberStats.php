<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List email stats for a subscriber.
 */
class ConvertKitListSubscriberStats extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_subscriber_stats';
    protected const TOOL_DESCRIPTION = 'List email stats for a subscriber.';
    protected const METHOD = 'GET';
    protected const PATH = '/subscribers/{subscriber_id}/stats';
    protected const PATH_KEYS = array (  0 => 'subscriber_id',);
    protected const QUERY_KEYS = array (  0 => 'email_sent_after',  1 => 'email_sent_before',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'subscriber_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for subscriber id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),  'email_sent_after' =>   array (    'type' => 'string',    'description' => 'Query parameter: email sent after.',  ),  'email_sent_before' =>   array (    'type' => 'string',    'description' => 'Query parameter: email sent before.',  ),);
    protected const DYNAMIC_PATH = false;
}
