<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Update a phone number from a contact.
 */
class AircallUpdateContactPhoneNumber extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_update_contact_phone_number';
    protected const TOOL_DESCRIPTION = 'Update a phone number from a contact.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/contacts/{contact_id}/phone_numbers/{phone_number_id}';
    protected const PATH_KEYS = array (  0 => 'contact_id',  1 => 'phone_number_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'label',  1 => 'value',);
    protected const PARAMETERS = array (  'contact_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for contact id.',  ),  'phone_number_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for phone number id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'label' =>   array (    'type' => 'string',    'description' => 'Body field: label.',  ),  'value' =>   array (    'type' => 'string',    'description' => 'Body field: value.',  ),);
    protected const DYNAMIC_PATH = false;
}
