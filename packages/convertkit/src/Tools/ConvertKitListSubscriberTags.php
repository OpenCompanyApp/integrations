<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List tags applied to a subscriber.
 */
class ConvertKitListSubscriberTags extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_subscriber_tags';
    protected const TOOL_DESCRIPTION = 'List tags applied to a subscriber.';
    protected const METHOD = 'GET';
    protected const PATH = '/subscribers/{subscriber_id}/tags';
    protected const PATH_KEYS = array (  0 => 'subscriber_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'subscriber_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for subscriber id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
