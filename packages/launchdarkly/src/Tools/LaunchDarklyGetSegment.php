<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Get a LaunchDarkly segment.
 */
class LaunchDarklyGetSegment extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_get_segment';
    protected const DESCRIPTION = 'Get a LaunchDarkly segment by project key, environment key, and segment key.';
    protected const METHOD = 'GET';
    protected const PATH = '/segments/{project_key}/{environment_key}/{segment_key}';
    protected const REQUIRED = ['project_key', 'environment_key', 'segment_key'];
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'environment_key' => ['type' => 'string', 'required' => true, 'description' => 'Environment key.'],
        'segment_key' => ['type' => 'string', 'required' => true, 'description' => 'Segment key.'],
    ];
}
