<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Enroll an authentication factor.
 *
 * Maps to the official WorkOS endpoint post /user_management/users/{userlandUserId}/auth_factors.
 */
class WorkOSUserlandUserAuthenticationFactorsCreate0 extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_authentication_factors_create_0';
    protected const DESCRIPTION = 'Enroll an authentication factor

Official WorkOS endpoint: POST /user_management/users/{userlandUserId}/auth_factors

Enrolls a user in a new [authentication factor](/reference/authkit/mfa/authentication-factor).';
    protected const PARAMETERS = array (
  'userland_user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userlandUserId` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/users/{userlandUserId}/auth_factors';
    protected const PATH_PARAMS = array (
  'userlandUserId' => 'userland_user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
