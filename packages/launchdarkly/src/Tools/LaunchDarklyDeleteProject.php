<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Delete a LaunchDarkly project.
 */
class LaunchDarklyDeleteProject extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_delete_project';
    protected const DESCRIPTION = 'Delete a LaunchDarkly project by key. LaunchDarkly will also delete associated environments and flags.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/projects/{project_key}';
    protected const REQUIRED = ['project_key'];
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
    ];
}
