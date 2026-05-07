<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Add an existing subscriber to a sequence by email address.
 */
class ConvertKitAddSubscriberToSequenceByEmail extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_add_subscriber_to_sequence_by_email';
    protected const TOOL_DESCRIPTION = 'Add an existing subscriber to a sequence by email address.';
    protected const METHOD = 'POST';
    protected const PATH = '/sequences/{sequence_id}/subscribers';
    protected const PATH_KEYS = array (  0 => 'sequence_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'email_address',);
    protected const PARAMETERS = array (  'sequence_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for sequence id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'email_address' =>   array (    'type' => 'string',    'description' => 'Body field: email address.',  ),);
    protected const DYNAMIC_PATH = false;
}
