<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Create an organization invitation.
 *
 * Sends an invitation to join a Clerk organization.
 */
class ClerkCreateOrganizationInvitation extends AbstractClerkTool
{
    protected const NAME = 'clerk_create_organization_invitation';
    protected const DESCRIPTION = 'Create and send an invitation to join a Clerk organization.';
    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk organization ID.'],
        'email_address' => ['type' => 'string', 'required' => true, 'description' => 'Invitee email address.'],
        'role' => ['type' => 'string', 'required' => true, 'description' => 'Organization role, such as org:member.'],
        'inviter_user_id' => ['type' => 'string', 'description' => 'Inviter user ID.'],
        'redirect_url' => ['type' => 'string', 'description' => 'Redirect URL after acceptance.'],
        'public_metadata' => ['type' => 'object', 'description' => 'Invitation public metadata.'],
        'body' => ['type' => 'object', 'description' => 'Raw invitation create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/organizations/{organization_id}/invitations';
    protected const REQUIRED = ['organization_id', 'email_address', 'role'];
    protected const BODY_KEYS = ['email_address', 'role', 'inviter_user_id', 'redirect_url', 'public_metadata'];
    protected const BODY_REQUIRED = true;
}
