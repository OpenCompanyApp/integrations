<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Update a policy.
 *
 * Maps to the official Bitwarden Public API endpoint put /public/policies/{type}.
 */
class BitwardenPoliciesPut extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_policies_put';
    protected const DESCRIPTION = 'Update a policy.

Official Bitwarden Public API endpoint: PUT /public/policies/{type}

Updates the specified policy. If a property is not provided, the value of the existing property will be reset.';
    protected const PARAMETERS = array (
  'type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The type of policy to be updated.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Bitwarden Public API request schema for this operation.',
  ),
);
    protected const METHOD = 'PUT';
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
