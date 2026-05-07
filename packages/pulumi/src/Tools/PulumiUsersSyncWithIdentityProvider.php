<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * SyncWithIdentityProvider.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/user/vcs/sync.
 */
class PulumiUsersSyncWithIdentityProvider extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_sync_with_identity_provider';
    protected const DESCRIPTION = 'SyncWithIdentityProvider

Official Pulumi Cloud endpoint: POST /api/user/vcs/sync

SyncWithIdentityProvider contacts the requesting user\'s identity provider, and updates their profile information (display name, avatar URL, etc.) This is required since we don\'t get update events from the identity provider when changes are made in the identity provider\'s system.';
    protected const PARAMETERS = array (
  'identity' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `identity` from the official Pulumi Cloud API operation. The VCS identity provider to sync profile data from (e.g., github, gitlab)',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/user/vcs/sync';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'identity' => 'identity',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
