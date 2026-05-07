<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

/**
 * Create a custom field on a list.
 */
class CampaignMonitorCreateCustomField extends AbstractCampaignMonitorEndpointTool
{
    protected const TOOL_NAME = 'campaignmonitor_create_custom_field';
    protected const TOOL_DESCRIPTION = 'Create a custom field on a list.';
    protected const METHOD = 'POST';
    protected const PATH = '/lists/{list_id}/customfields.json';
    protected const PATH_KEYS = array (  0 => 'list_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'FieldName',  1 => 'DataType',  2 => 'Options',  3 => 'VisibleInPreferenceCenter',);
    protected const PARAMETERS = array (  'list_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Campaign Monitor resource ID for list id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'FieldName' =>   array (    'type' => 'string',    'description' => 'Body field: FieldName.',  ),  'DataType' =>   array (    'type' => 'string',    'description' => 'Body field: DataType.',  ),  'Options' =>   array (    'type' => 'array',    'description' => 'Body field: Options.',  ),  'VisibleInPreferenceCenter' =>   array (    'type' => 'string',    'description' => 'Body field: VisibleInPreferenceCenter.',  ),);
    protected const DYNAMIC_PATH = false;
}
