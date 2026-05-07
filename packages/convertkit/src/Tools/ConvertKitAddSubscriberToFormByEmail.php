<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Add an existing subscriber to a form by email address.
 */
class ConvertKitAddSubscriberToFormByEmail extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_add_subscriber_to_form_by_email';
    protected const TOOL_DESCRIPTION = 'Add an existing subscriber to a form by email address.';
    protected const METHOD = 'POST';
    protected const PATH = '/forms/{form_id}/subscribers';
    protected const PATH_KEYS = array (  0 => 'form_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'email_address',);
    protected const PARAMETERS = array (  'form_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for form id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'email_address' =>   array (    'type' => 'string',    'description' => 'Body field: email address.',  ),);
    protected const DYNAMIC_PATH = false;
}
