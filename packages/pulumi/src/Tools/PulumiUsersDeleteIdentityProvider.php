<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteIdentityProvider.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/user/vcs.
 */
class PulumiUsersDeleteIdentityProvider extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_delete_identity_provider';
    protected const DESCRIPTION = 'DeleteIdentityProvider

Official Pulumi Cloud endpoint: DELETE /api/user/vcs

DeleteIdentityProvider removes a VCS identity provider from the current user\'s account.';
    protected const PARAMETERS = array (
  'identity' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `identity` from the official Pulumi Cloud API operation. The VCS identity provider to disconnect (e.g., github, gitlab, bitbucket)',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/user/vcs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'identity' => 'identity',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
