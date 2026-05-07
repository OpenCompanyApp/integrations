<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Send a transactional classic email.
 */
class CampaignMonitorSendClassicEmail extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_send_classic_email';
    protected const TOOL_DESCRIPTION = 'Send a transactional classic email.';
    protected const METHOD = 'POST';
    protected const PATH = '/transactional/classicEmail/send';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'clientID',);
    protected const BODY_KEYS = array (  0 => 'Subject',  1 => 'From',  2 => 'ReplyTo',  3 => 'To',  4 => 'CC',  5 => 'BCC',  6 => 'Html',  7 => 'Text',  8 => 'Attachments',  9 => 'TrackOpens',  10 => 'TrackClicks',  11 => 'InlineCSS',  12 => 'Group',  13 => 'AddRecipientToListID',  14 => 'ConsentToTrack',);
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'clientID' =>   array (    'type' => 'string',    'description' => 'Query parameter: clientID.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'Subject' =>   array (    'type' => 'string',    'description' => 'Body field: Subject.',  ),  'From' =>   array (    'type' => 'string',    'description' => 'Body field: From.',  ),  'ReplyTo' =>   array (    'type' => 'string',    'description' => 'Body field: ReplyTo.',  ),  'To' =>   array (    'type' => 'array',    'description' => 'Body field: To.',  ),  'CC' =>   array (    'type' => 'array',    'description' => 'Body field: CC.',  ),  'BCC' =>   array (    'type' => 'array',    'description' => 'Body field: BCC.',  ),  'Html' =>   array (    'type' => 'string',    'description' => 'Body field: Html.',  ),  'Text' =>   array (    'type' => 'string',    'description' => 'Body field: Text.',  ),  'Attachments' =>   array (    'type' => 'array',    'description' => 'Body field: Attachments.',  ),  'TrackOpens' =>   array (    'type' => 'string',    'description' => 'Body field: TrackOpens.',  ),  'TrackClicks' =>   array (    'type' => 'string',    'description' => 'Body field: TrackClicks.',  ),  'InlineCSS' =>   array (    'type' => 'string',    'description' => 'Body field: InlineCSS.',  ),  'Group' =>   array (    'type' => 'string',    'description' => 'Body field: Group.',  ),  'AddRecipientToListID' =>   array (    'type' => 'string',    'description' => 'Body field: AddRecipientToListID.',  ),  'ConsentToTrack' =>   array (    'type' => 'string',    'description' => 'Body field: ConsentToTrack.',  ),);
    protected const DYNAMIC_PATH = false;
}
