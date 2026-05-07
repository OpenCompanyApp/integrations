<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeletePendingEmailChange.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/user/pending-emails.
 */
class PulumiUsersDeletePendingEmailChange extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_delete_pending_email_change';
    protected const DESCRIPTION = 'DeletePendingEmailChange

Official Pulumi Cloud endpoint: DELETE /api/user/pending-emails

DeletePendingEmailChange removes the pending email change for the currently logged-in user. Deletes the pending verification only if it isn\'t a verification record for the current primary email itself.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/user/pending-emails';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
