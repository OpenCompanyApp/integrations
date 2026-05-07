<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Revoke an application invitation.
 *
 * Makes a pending application invitation invalid.
 */
class ClerkRevokeInvitation extends AbstractClerkTool
{
    protected const NAME = 'clerk_revoke_invitation';
    protected const DESCRIPTION = 'Revoke a Clerk application invitation.';
    protected const PARAMETERS = [
        'invitation_id' => ['type' => 'string', 'required' => true, 'description' => 'Invitation ID.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/invitations/{invitation_id}/revoke';
    protected const REQUIRED = ['invitation_id'];
}
