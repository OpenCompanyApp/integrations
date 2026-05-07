<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a list of contact groups for an account..
 *
 * Maps to the official StatusCake endpoint GET /contact-groups.
 */
class StatusCakeListContactGroups extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_list_contact_groups';
    protected const DESCRIPTION = 'Returns a list of contact groups for an account.

Official StatusCake endpoint: GET /contact-groups.';
    protected const PARAMETERS = array (
      'page' => array (
        'type' => 'integer',
        'description' => 'Page of results',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The number of contact groups to return per page',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/contact-groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'page' => 'page',
      'limit' => 'limit',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
