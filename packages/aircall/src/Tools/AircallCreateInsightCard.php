<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Create an insight card on a call.
 */
class AircallCreateInsightCard extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_create_insight_card';
    protected const TOOL_DESCRIPTION = 'Create an insight card on a call.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/calls/{call_id}/insight_cards';
    protected const PATH_KEYS = array (  0 => 'call_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'contents',);
    protected const PARAMETERS = array (  'call_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for call id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'contents' =>   array (    'type' => 'array',    'description' => 'Body field: contents.',  ),);
    protected const DYNAMIC_PATH = false;
}
