<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Create an application invitation.
 *
 * Sends an invitation for a user to sign up to the application.
 */
class ClerkCreateInvitation extends AbstractClerkTool
{
    protected const NAME = 'clerk_create_invitation';
    protected const DESCRIPTION = 'Create a Clerk application invitation.';
    protected const PARAMETERS = [
        'email_address' => ['type' => 'string', 'required' => true, 'description' => 'Invitee email address.'],
        'redirect_url' => ['type' => 'string', 'description' => 'Redirect URL after acceptance.'],
        'public_metadata' => ['type' => 'object', 'description' => 'Invitation public metadata.'],
        'body' => ['type' => 'object', 'description' => 'Raw invitation create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/invitations';
    protected const REQUIRED = ['email_address'];
    protected const BODY_KEYS = ['email_address', 'redirect_url', 'public_metadata'];
    protected const BODY_REQUIRED = true;
}
