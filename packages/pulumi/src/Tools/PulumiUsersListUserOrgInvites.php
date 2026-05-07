<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListUserOrgInvites.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/user/pending-invites.
 */
class PulumiUsersListUserOrgInvites extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_list_user_org_invites';
    protected const DESCRIPTION = 'ListUserOrgInvites

Official Pulumi Cloud endpoint: GET /api/user/pending-invites

ListUserOrgInvites lists the pending invites for the requesting user.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/user/pending-invites';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
