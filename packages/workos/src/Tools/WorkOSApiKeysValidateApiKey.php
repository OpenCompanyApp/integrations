<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Validate API key.
 *
 * Maps to the official WorkOS endpoint post /api_keys/validations.
 */
class WorkOSApiKeysValidateApiKey extends AbstractWorkOSTool
{
    protected const NAME = 'workos_api_keys_validate_api_key';
    protected const DESCRIPTION = 'Validate API key

Official WorkOS endpoint: POST /api_keys/validations

Validate an API key value and return the API key object if valid.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api_keys/validations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
