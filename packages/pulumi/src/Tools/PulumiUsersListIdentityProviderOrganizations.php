<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListIdentityProviderOrganizations.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/user/vcs/organizations.
 */
class PulumiUsersListIdentityProviderOrganizations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_list_identity_provider_organizations';
    protected const DESCRIPTION = 'ListIdentityProviderOrganizations

Official Pulumi Cloud endpoint: GET /api/user/vcs/organizations

ListIdentityProviderOrganizations lists all of the organizations from a backing VCS visible to the Pulumi Service for the requesting user. Ignores errors if this user doesn\'t have a specific backing identity.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/user/vcs/organizations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
