<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Invite new LaunchDarkly account members.
 */
class LaunchDarklyInviteMembers extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_invite_members';
    protected const DESCRIPTION = 'Invite one or more LaunchDarkly account members. The request body must be a list of member invite objects.';
    protected const METHOD = 'POST';
    protected const PATH = '/members';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'body' => ['type' => 'array', 'required' => true, 'description' => 'List of invite objects. Each object must include email and either role or customRoles.'],
    ];
}
