<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Deletes a personal access token.
 *
 * Maps to the official Snyk endpoint delete /self/personal_access_tokens/{personal_access_token_id}.
 */
class SnykDeletePersonalAccessToken extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_personal_access_token';
    protected const DESCRIPTION = 'Deletes a personal access token

Official Snyk endpoint: DELETE /self/personal_access_tokens/{personal_access_token_id}

Delete a personal access token';
    protected const PARAMETERS = array (
  'personal_access_token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `personal_access_token_id` from the official Snyk API operation. The personal access token id',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/self/personal_access_tokens/{personal_access_token_id}';
    protected const PATH_PARAMS = array (
  'personal_access_token_id' => 'personal_access_token_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
