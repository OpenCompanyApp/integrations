<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Update an email from a contact.
 */
class AircallUpdateContactEmail extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_update_contact_email';
    protected const TOOL_DESCRIPTION = 'Update an email from a contact.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/contacts/{contact_id}/emails/{email_id}';
    protected const PATH_KEYS = array (  0 => 'contact_id',  1 => 'email_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'label',  1 => 'value',);
    protected const PARAMETERS = array (  'contact_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for contact id.',  ),  'email_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for email id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'label' =>   array (    'type' => 'string',    'description' => 'Body field: label.',  ),  'value' =>   array (    'type' => 'string',    'description' => 'Body field: value.',  ),);
    protected const DYNAMIC_PATH = false;
}
