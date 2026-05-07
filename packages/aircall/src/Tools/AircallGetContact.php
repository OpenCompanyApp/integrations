<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve a contact.
 */
class AircallGetContact extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_contact';
    protected const TOOL_DESCRIPTION = 'Retrieve a contact.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/contacts/{contact_id}';
    protected const PATH_KEYS = array (  0 => 'contact_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'contact_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for contact id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
