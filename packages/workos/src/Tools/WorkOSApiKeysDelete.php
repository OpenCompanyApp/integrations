<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete an API key.
 *
 * Maps to the official WorkOS endpoint delete /api_keys/{id}.
 */
class WorkOSApiKeysDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_api_keys_delete';
    protected const DESCRIPTION = 'Delete an API key

Official WorkOS endpoint: DELETE /api_keys/{id}

Permanently deletes an API key. This action cannot be undone. Once deleted, any requests using this API key will fail authentication.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api_keys/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
