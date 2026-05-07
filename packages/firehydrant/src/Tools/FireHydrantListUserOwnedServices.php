<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List services owned by a user's teams.
 *
 * Maps to the official FireHydrant endpoint get /v1/users/{id}/services.
 */
class FireHydrantListUserOwnedServices extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_user_owned_services';
    protected const DESCRIPTION = 'List services owned by a user\'s teams

Official FireHydrant endpoint: GET /v1/users/{id}/services

Retrieves a list of services owned by the teams a user is on';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/users/{id}/services';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
