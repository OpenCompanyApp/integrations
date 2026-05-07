<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Delete a LaunchDarkly environment.
 */
class LaunchDarklyDeleteEnvironment extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_delete_environment';
    protected const DESCRIPTION = 'Delete a LaunchDarkly environment by project key and environment key.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/projects/{project_key}/environments/{environment_key}';
    protected const REQUIRED = ['project_key', 'environment_key'];
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'environment_key' => ['type' => 'string', 'required' => true, 'description' => 'Environment key.'],
    ];
}
