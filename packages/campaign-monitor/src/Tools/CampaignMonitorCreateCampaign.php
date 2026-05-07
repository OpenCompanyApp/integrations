<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Create a draft campaign for a client.
 */
class CampaignMonitorCreateCampaign extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_create_campaign';
    protected const TOOL_DESCRIPTION = 'Create a draft campaign for a client.';
    protected const METHOD = 'POST';
    protected const PATH = '/campaigns/{client_id}.json';
    protected const PATH_KEYS = array (  0 => 'client_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'Name',  1 => 'Subject',  2 => 'FromName',  3 => 'FromEmail',  4 => 'ReplyTo',  5 => 'HtmlUrl',  6 => 'TextUrl',  7 => 'ListIDs',  8 => 'SegmentIDs',  9 => 'InlineCss',  10 => 'Tags',);
    protected const PARAMETERS = array (  'client_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for client id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'Name' =>   array (    'type' => 'string',    'description' => 'Body field: Name.',  ),  'Subject' =>   array (    'type' => 'string',    'description' => 'Body field: Subject.',  ),  'FromName' =>   array (    'type' => 'string',    'description' => 'Body field: FromName.',  ),  'FromEmail' =>   array (    'type' => 'string',    'description' => 'Body field: FromEmail.',  ),  'ReplyTo' =>   array (    'type' => 'string',    'description' => 'Body field: ReplyTo.',  ),  'HtmlUrl' =>   array (    'type' => 'string',    'description' => 'Body field: HtmlUrl.',  ),  'TextUrl' =>   array (    'type' => 'string',    'description' => 'Body field: TextUrl.',  ),  'ListIDs' =>   array (    'type' => 'array',    'description' => 'Body field: ListIDs.',  ),  'SegmentIDs' =>   array (    'type' => 'array',    'description' => 'Body field: SegmentIDs.',  ),  'InlineCss' =>   array (    'type' => 'string',    'description' => 'Body field: InlineCss.',  ),  'Tags' =>   array (    'type' => 'array',    'description' => 'Body field: Tags.',  ),);
    protected const DYNAMIC_PATH = false;
}
