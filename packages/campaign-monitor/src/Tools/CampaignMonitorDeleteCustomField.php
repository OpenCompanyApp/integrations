<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Delete a custom field from a list.
 */
class CampaignMonitorDeleteCustomField extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_delete_custom_field';
    protected const TOOL_DESCRIPTION = 'Delete a custom field from a list.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/lists/{list_id}/customfields/{custom_field_key}.json';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'custom_field_key',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'custom_field_key' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for custom field key.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
