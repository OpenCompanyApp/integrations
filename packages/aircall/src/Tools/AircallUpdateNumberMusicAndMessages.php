<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Update number music and messages.
 */
class AircallUpdateNumberMusicAndMessages extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_update_number_music_and_messages';
    protected const TOOL_DESCRIPTION = 'Update number music and messages.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/numbers/{number_id}/messages';
    protected const PATH_KEYS = array (  0 => 'number_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'messages',);
    protected const PARAMETERS = array (  'number_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for number id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'messages' =>   array (    'type' => 'array',    'description' => 'Body field: messages.',  ),);
    protected const DYNAMIC_PATH = false;
}
