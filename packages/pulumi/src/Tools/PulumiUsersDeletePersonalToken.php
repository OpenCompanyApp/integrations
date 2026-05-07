<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeletePersonalToken.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/user/tokens/{tokenId}.
 */
class PulumiUsersDeletePersonalToken extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_delete_personal_token';
    protected const DESCRIPTION = 'DeletePersonalToken

Official Pulumi Cloud endpoint: DELETE /api/user/tokens/{tokenId}

Permanently deletes a personal access token by its identifier. The token is immediately invalidated and can no longer be used for authentication. Returns 204 on success or 404 if the token does not exist.';
    protected const PARAMETERS = array (
  'token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tokenId` from the official Pulumi Cloud API operation. The access token identifier',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/user/tokens/{tokenId}';
    protected const PATH_PARAMS = array (
  'tokenId' => 'token_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
