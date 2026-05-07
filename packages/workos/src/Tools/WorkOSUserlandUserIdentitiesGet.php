<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get user identities.
 *
 * Maps to the official WorkOS endpoint get /user_management/users/{id}/identities.
 */
class WorkOSUserlandUserIdentitiesGet extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_identities_get';
    protected const DESCRIPTION = 'Get user identities

Official WorkOS endpoint: GET /user_management/users/{id}/identities

Get a list of identities associated with the user. A user can have multiple associated identities after going through [identity linking](/authkit/identity-linking). Currently only OAuth identities are supported. More provider types may be added in the future.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/users/{id}/identities';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
