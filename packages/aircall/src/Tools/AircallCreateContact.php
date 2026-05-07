<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Create a contact.
 */
class AircallCreateContact extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_create_contact';
    protected const TOOL_DESCRIPTION = 'Create a contact.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/contacts';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'first_name',  1 => 'last_name',  2 => 'company_name',  3 => 'information',  4 => 'phone_numbers',  5 => 'emails',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'first_name' =>   array (    'type' => 'string',    'description' => 'Body field: first_name.',  ),  'last_name' =>   array (    'type' => 'string',    'description' => 'Body field: last_name.',  ),  'company_name' =>   array (    'type' => 'string',    'description' => 'Body field: company_name.',  ),  'information' =>   array (    'type' => 'string',    'description' => 'Body field: information.',  ),  'phone_numbers' =>   array (    'type' => 'array',    'description' => 'Body field: phone_numbers.',  ),  'emails' =>   array (    'type' => 'array',    'description' => 'Body field: emails.',  ),);
    protected const DYNAMIC_PATH = false;
}
