<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Get a LaunchDarkly environment.
 */
class LaunchDarklyGetEnvironment extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_get_environment';
    protected const DESCRIPTION = 'Get a single LaunchDarkly environment by project key and environment key.';
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{project_key}/environments/{environment_key}';
    protected const REQUIRED = ['project_key', 'environment_key'];
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'environment_key' => ['type' => 'string', 'required' => true, 'description' => 'Environment key.'],
    ];
}
