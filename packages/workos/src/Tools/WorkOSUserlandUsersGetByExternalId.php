<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a user by external ID.
 *
 * Maps to the official WorkOS endpoint get /user_management/users/external_id/{external_id}.
 */
class WorkOSUserlandUsersGetByExternalId extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_get_by_external_id';
    protected const DESCRIPTION = 'Get a user by external ID

Official WorkOS endpoint: GET /user_management/users/external_id/{external_id}

Get the details of an existing user by an [external identifier](/authkit/metadata/external-identifiers).';
    protected const PARAMETERS = array (
  'external_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `external_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/users/external_id/{external_id}';
    protected const PATH_PARAMS = array (
  'external_id' => 'external_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
