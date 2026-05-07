<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List SCIM users.
 *
 * Maps to the official FireHydrant endpoint get /v1/scim/v2/Users.
 */
class FireHydrantListScimUsers extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_scim_users';
    protected const DESCRIPTION = 'List SCIM users

Official FireHydrant endpoint: GET /v1/scim/v2/Users

SCIM endpoint that lists users. This endpoint will display a list of Users currently in the system.';
    protected const PARAMETERS = array (
  'filter' =>
  array (
    'type' => 'string',
    'description' => 'This is a string used to query users by either userName or email.
        Proper example syntax for this would be `?filter=userName eq john` or `?filter=userName eq "john@firehydrant.com"`.
        Currently we only support the `eq` operator',
  ),
  'start_index' =>
  array (
    'type' => 'integer',
    'description' => 'This is an integer which represents a pagination offset',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'description' => 'This is an integer which represents the number of items per page in the response',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/scim/v2/Users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'filter' => 'filter',
  'startIndex' => 'start_index',
  'count' => 'count',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
