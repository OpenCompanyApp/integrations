<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Delete a LaunchDarkly account member.
 */
class LaunchDarklyDeleteMember extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_delete_member';
    protected const DESCRIPTION = 'Remove a LaunchDarkly account member by member ID.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/members/{member_id}';
    protected const REQUIRED = ['member_id'];
    protected const PARAMETERS = [
        'member_id' => ['type' => 'string', 'required' => true, 'description' => 'Member ID.'],
    ];
}
