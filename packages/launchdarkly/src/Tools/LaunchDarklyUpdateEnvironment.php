<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Update a LaunchDarkly environment using JSON Patch.
 */
class LaunchDarklyUpdateEnvironment extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_update_environment';
    protected const DESCRIPTION = 'Update a LaunchDarkly environment. LaunchDarkly expects a JSON Patch body for environment updates.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/projects/{project_key}/environments/{environment_key}';
    protected const REQUIRED = ['project_key', 'environment_key'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'environment_key' => ['type' => 'string', 'required' => true, 'description' => 'Environment key.'],
        'patch' => ['type' => 'array', 'required' => true, 'description' => 'JSON Patch operations.'],
        'body' => ['type' => 'object', 'description' => 'Alternate JSON Patch body.'],
    ];
}
