<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Delete a LaunchDarkly feature flag.
 */
class LaunchDarklyDeleteFeatureFlag extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_delete_feature_flag';
    protected const DESCRIPTION = 'Delete a LaunchDarkly feature flag by project key and flag key.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/flags/{project_key}/{feature_flag_key}';
    protected const REQUIRED = ['project_key', 'feature_flag_key'];
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'feature_flag_key' => ['type' => 'string', 'required' => true, 'description' => 'Feature flag key.'],
    ];
}
