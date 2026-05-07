<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Update a LaunchDarkly project using JSON Patch.
 */
class LaunchDarklyUpdateProject extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_update_project';
    protected const DESCRIPTION = 'Update a LaunchDarkly project. LaunchDarkly expects a JSON Patch body for project updates.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/projects/{project_key}';
    protected const REQUIRED = ['project_key'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'patch' => ['type' => 'array', 'required' => true, 'description' => 'JSON Patch operations, such as [{"op":"replace","path":"/name","value":"New name"}].'],
        'body' => ['type' => 'object', 'description' => 'Alternate JSON Patch body.'],
    ];
}
