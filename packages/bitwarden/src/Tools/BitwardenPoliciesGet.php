<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Retrieve a policy.
 *
 * Maps to the official Bitwarden Public API endpoint get /public/policies/{type}.
 */
class BitwardenPoliciesGet extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_policies_get';
    protected const DESCRIPTION = 'Retrieve a policy.

Official Bitwarden Public API endpoint: GET /public/policies/{type}

Retrieves the details of a policy.';
    protected const PARAMETERS = array (
  'type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The type of policy to be retrieved.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/public/policies/{type}';
    protected const PATH_PARAMS = array (
  'type' => 'type',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
