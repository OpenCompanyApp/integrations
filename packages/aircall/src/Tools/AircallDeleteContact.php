<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Delete a contact.
 */
class AircallDeleteContact extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_delete_contact';
    protected const TOOL_DESCRIPTION = 'Delete a contact.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/contacts/{contact_id}';
    protected const PATH_KEYS = array (  0 => 'contact_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'contact_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for contact id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
