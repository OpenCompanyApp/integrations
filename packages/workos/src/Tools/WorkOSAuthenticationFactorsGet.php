<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get Factor.
 *
 * Maps to the official WorkOS endpoint get /auth/factors/{id}.
 */
class WorkOSAuthenticationFactorsGet extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authentication_factors_get';
    protected const DESCRIPTION = 'Get Factor

Official WorkOS endpoint: GET /auth/factors/{id}

Gets an Authentication Factor.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/auth/factors/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
