<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Create a LaunchDarkly environment.
 */
class LaunchDarklyCreateEnvironment extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_create_environment';
    protected const DESCRIPTION = 'Create a LaunchDarkly environment in a project.';
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{project_key}/environments';
    protected const REQUIRED = ['project_key', 'name', 'key', 'color'];
    protected const BODY_KEYS = ['name', 'key', 'color', 'defaultTtl', 'secureMode', 'defaultTrackEvents', 'confirmChanges', 'requireComments', 'tags'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Human-readable environment name.'],
        'key' => ['type' => 'string', 'required' => true, 'description' => 'Unique environment key.'],
        'color' => ['type' => 'string', 'required' => true, 'description' => 'Six-character color swatch, such as DADBEE.'],
        'defaultTtl' => ['type' => 'integer', 'description' => 'Default TTL in minutes.'],
        'secureMode' => ['type' => 'boolean', 'description' => 'Enable secure mode.'],
        'defaultTrackEvents' => ['type' => 'boolean', 'description' => 'Track events by default.'],
        'confirmChanges' => ['type' => 'boolean', 'description' => 'Require confirmation for environment changes.'],
        'requireComments' => ['type' => 'boolean', 'description' => 'Require comments for changes.'],
        'tags' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Environment tags.'],
        'body' => ['type' => 'object', 'description' => 'Additional environment fields accepted by LaunchDarkly.'],
    ];
}
