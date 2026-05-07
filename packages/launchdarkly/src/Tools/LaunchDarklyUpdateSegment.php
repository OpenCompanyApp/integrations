<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Update a LaunchDarkly segment.
 */
class LaunchDarklyUpdateSegment extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_update_segment';
    protected const DESCRIPTION = 'Update a LaunchDarkly segment using a LaunchDarkly-supported patch body.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/segments/{project_key}/{environment_key}/{segment_key}';
    protected const REQUIRED = ['project_key', 'environment_key', 'segment_key'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'environment_key' => ['type' => 'string', 'required' => true, 'description' => 'Environment key.'],
        'segment_key' => ['type' => 'string', 'required' => true, 'description' => 'Segment key.'],
        'patch' => ['type' => 'array', 'description' => 'JSON Patch operations.'],
        'body' => ['type' => 'object', 'description' => 'Alternate patch body accepted by LaunchDarkly.'],
    ];
}
