<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Verify Challenge.
 *
 * Maps to the official WorkOS endpoint post /auth/challenges/{id}/verify.
 */
class WorkOSAuthenticationChallengesVerify extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authentication_challenges_verify';
    protected const DESCRIPTION = 'Verify Challenge

Official WorkOS endpoint: POST /auth/challenges/{id}/verify

Verifies an Authentication Challenge.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/auth/challenges/{id}/verify';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
