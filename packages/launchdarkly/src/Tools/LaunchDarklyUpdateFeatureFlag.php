<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Update a LaunchDarkly feature flag.
 */
class LaunchDarklyUpdateFeatureFlag extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_update_feature_flag';
    protected const DESCRIPTION = 'Update a LaunchDarkly feature flag. Use JSON Patch, JSON merge patch, or a semantic-patch-style body accepted by LaunchDarkly.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/flags/{project_key}/{feature_flag_key}';
    protected const REQUIRED = ['project_key', 'feature_flag_key'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'feature_flag_key' => ['type' => 'string', 'required' => true, 'description' => 'Feature flag key.'],
        'patch' => ['type' => 'array', 'description' => 'JSON Patch operations, such as replacing /environments/production/on.'],
        'body' => ['type' => 'object', 'description' => 'JSON merge patch or semantic patch payload, such as {"environmentKey":"production","instructions":[{"kind":"turnFlagOn"}]}.'],
    ];
}
