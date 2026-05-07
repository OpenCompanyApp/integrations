<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Enroll Factor.
 *
 * Maps to the official WorkOS endpoint post /auth/factors/enroll.
 */
class WorkOSAuthenticationFactorsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authentication_factors_create';
    protected const DESCRIPTION = 'Enroll Factor

Official WorkOS endpoint: POST /auth/factors/enroll

Enrolls an Authentication Factor to be used as an additional factor of authentication. The returned ID should be used to create an authentication Challenge.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/auth/factors/enroll';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
