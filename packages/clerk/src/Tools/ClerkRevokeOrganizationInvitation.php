<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Revoke an organization invitation.
 *
 * Makes a pending organization invitation invalid.
 */
class ClerkRevokeOrganizationInvitation extends AbstractClerkTool
{
    protected const NAME = 'clerk_revoke_organization_invitation';
    protected const DESCRIPTION = 'Revoke a pending Clerk organization invitation.';
    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk organization ID.'],
        'invitation_id' => ['type' => 'string', 'required' => true, 'description' => 'Organization invitation ID.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/organizations/{organization_id}/invitations/{invitation_id}/revoke';
    protected const REQUIRED = ['organization_id', 'invitation_id'];
}
