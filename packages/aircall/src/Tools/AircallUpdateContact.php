<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Update a contact.
 */
class AircallUpdateContact extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_update_contact';
    protected const TOOL_DESCRIPTION = 'Update a contact.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/contacts/{contact_id}';
    protected const PATH_KEYS = array (  0 => 'contact_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'first_name',  1 => 'last_name',  2 => 'company_name',  3 => 'information',);
    protected const PARAMETERS = array (  'contact_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for contact id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'first_name' =>   array (    'type' => 'string',    'description' => 'Body field: first_name.',  ),  'last_name' =>   array (    'type' => 'string',    'description' => 'Body field: last_name.',  ),  'company_name' =>   array (    'type' => 'string',    'description' => 'Body field: company_name.',  ),  'information' =>   array (    'type' => 'string',    'description' => 'Body field: information.',  ),);
    protected const DYNAMIC_PATH = false;
}
