<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Unsubscribe a subscriber by ID.
 */
class ConvertKitUnsubscribeSubscriber extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_unsubscribe_subscriber';
    protected const TOOL_DESCRIPTION = 'Unsubscribe a subscriber by ID.';
    protected const METHOD = 'POST';
    protected const PATH = '/subscribers/{id}/unsubscribe';
    protected const PATH_KEYS = array (  0 => 'id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
