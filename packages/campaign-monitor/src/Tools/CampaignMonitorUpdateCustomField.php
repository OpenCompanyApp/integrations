<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Update a custom field on a list.
 */
class CampaignMonitorUpdateCustomField extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_update_custom_field';
    protected const TOOL_DESCRIPTION = 'Update a custom field on a list.';
    protected const METHOD = 'PUT';
    protected const PATH = '/lists/{list_id}/customfields/{custom_field_key}.json';
    protected const PATH_KEYS = array (  0 => 'list_id',  1 => 'custom_field_key',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'FieldName',  1 => 'VisibleInPreferenceCenter',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'custom_field_key' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for custom field key.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'FieldName' =>   array (    'type' => 'string',    'description' => 'Body field: FieldName.',  ),  'VisibleInPreferenceCenter' =>   array (    'type' => 'string',    'description' => 'Body field: VisibleInPreferenceCenter.',  ),);
    protected const DYNAMIC_PATH = false;
}
