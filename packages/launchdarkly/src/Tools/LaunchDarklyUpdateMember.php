<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Update a LaunchDarkly account member.
 */
class LaunchDarklyUpdateMember extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_update_member';
    protected const DESCRIPTION = 'Update a LaunchDarkly member by member ID using JSON Patch.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/members/{member_id}';
    protected const REQUIRED = ['member_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'member_id' => ['type' => 'string', 'required' => true, 'description' => 'Member ID.'],
        'patch' => ['type' => 'array', 'description' => 'JSON Patch operations.'],
        'body' => ['type' => 'object', 'description' => 'Alternate patch body accepted by LaunchDarkly.'],
    ];
}
