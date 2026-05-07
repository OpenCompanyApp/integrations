<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetLatestPendingEmailChange.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/user/pending-emails.
 */
class PulumiUsersGetLatestPendingEmailChange extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_get_latest_pending_email_change';
    protected const DESCRIPTION = 'GetLatestPendingEmailChange

Official Pulumi Cloud endpoint: GET /api/user/pending-emails

GetLatestPendingEmailChange returns only the latest email change, that is pending. Returns a 204 if no pending email change requests exist.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/user/pending-emails';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
