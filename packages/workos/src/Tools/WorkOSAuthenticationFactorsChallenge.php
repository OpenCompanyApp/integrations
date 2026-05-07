<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Challenge Factor.
 *
 * Maps to the official WorkOS endpoint post /auth/factors/{id}/challenge.
 */
class WorkOSAuthenticationFactorsChallenge extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authentication_factors_challenge';
    protected const DESCRIPTION = 'Challenge Factor

Official WorkOS endpoint: POST /auth/factors/{id}/challenge

Creates a Challenge for an Authentication Factor.';
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
    protected const PATH = '/auth/factors/{id}/challenge';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
