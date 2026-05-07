<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Filter subscribers based on engagement.
 */
class ConvertKitFilterSubscribers extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_filter_subscribers';
    protected const TOOL_DESCRIPTION = 'Filter subscribers based on engagement.';
    protected const METHOD = 'POST';
    protected const PATH = '/subscribers/filter';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'emails',  1 => 'segment_ids',  2 => 'tag_ids',  3 => 'engagement_score',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'emails' =>   array (    'type' => 'array',    'description' => 'Body field: emails.',  ),  'segment_ids' =>   array (    'type' => 'array',    'description' => 'Body field: segment ids.',  ),  'tag_ids' =>   array (    'type' => 'array',    'description' => 'Body field: tag ids.',  ),  'engagement_score' =>   array (    'type' => 'string',    'description' => 'Body field: engagement score.',  ),);
    protected const DYNAMIC_PATH = false;
}
