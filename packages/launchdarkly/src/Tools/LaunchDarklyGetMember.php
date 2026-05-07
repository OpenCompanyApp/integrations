<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Get a LaunchDarkly account member.
 */
class LaunchDarklyGetMember extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_get_member';
    protected const DESCRIPTION = 'Get a LaunchDarkly account member by member ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/members/{member_id}';
    protected const REQUIRED = ['member_id'];
    protected const PARAMETERS = [
        'member_id' => ['type' => 'string', 'required' => true, 'description' => 'Member ID from the _id field in member list responses.'],
    ];
}
