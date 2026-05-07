<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * List contacts.
 */
class AircallListContacts extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_list_contacts';
    protected const TOOL_DESCRIPTION = 'List contacts.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/contacts';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array (  0 => 'page',  1 => 'per_page',  2 => 'order',  3 => 'q',  4 => 'phone_number',  5 => 'email',);
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),  'page' =>   array (    'type' => 'string',    'description' => 'Query parameter: page.',  ),  'per_page' =>   array (    'type' => 'string',    'description' => 'Query parameter: per_page.',  ),  'order' =>   array (    'type' => 'string',    'description' => 'Query parameter: order.',  ),  'q' =>   array (    'type' => 'string',    'description' => 'Query parameter: q.',  ),  'phone_number' =>   array (    'type' => 'string',    'description' => 'Query parameter: phone_number.',  ),  'email' =>   array (    'type' => 'string',    'description' => 'Query parameter: email.',  ),);
    protected const DYNAMIC_PATH = false;
}
