<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Add an existing subscriber to a sequence by subscriber ID.
 */
class ConvertKitAddSubscriberToSequence extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_add_subscriber_to_sequence';
    protected const TOOL_DESCRIPTION = 'Add an existing subscriber to a sequence by subscriber ID.';
    protected const METHOD = 'POST';
    protected const PATH = '/sequences/{sequence_id}/subscribers/{id}';
    protected const PATH_KEYS = array (  0 => 'sequence_id',  1 => 'id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'sequence_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for sequence id.',  ),  'id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
