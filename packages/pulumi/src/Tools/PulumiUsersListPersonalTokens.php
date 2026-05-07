<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPersonalTokens.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/user/tokens.
 */
class PulumiUsersListPersonalTokens extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_list_personal_tokens';
    protected const DESCRIPTION = 'ListPersonalTokens

Official Pulumi Cloud endpoint: GET /api/user/tokens

Returns all personal access tokens for the authenticated user. Web-session generated tokens (type \'web\') are excluded from the results. Each token in the response includes its ID, description, and lastUsed timestamp. Use the filter query parameter to search tokens by name or description.';
    protected const PARAMETERS = array (
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `filter` from the official Pulumi Cloud API operation. Filter tokens by name or description',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/user/tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'filter' => 'filter',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
