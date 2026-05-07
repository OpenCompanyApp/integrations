<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Copy LaunchDarkly feature flag settings between environments.
 */
class LaunchDarklyCopyFeatureFlag extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_copy_feature_flag';
    protected const DESCRIPTION = 'Copy feature flag settings from one environment to another. This LaunchDarkly capability may require an Enterprise plan.';
    protected const METHOD = 'POST';
    protected const PATH = '/flags/{project_key}/{feature_flag_key}/copy';
    protected const REQUIRED = ['project_key', 'feature_flag_key', 'source', 'target'];
    protected const BODY_KEYS = ['source', 'target', 'comment', 'includedActions', 'excludedActions'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'feature_flag_key' => ['type' => 'string', 'required' => true, 'description' => 'Feature flag key.'],
        'source' => ['type' => 'object', 'required' => true, 'description' => 'Source environment object, e.g. {"key":"staging","currentVersion":1}.'],
        'target' => ['type' => 'object', 'required' => true, 'description' => 'Target environment object, e.g. {"key":"production","currentVersion":1}.'],
        'comment' => ['type' => 'string', 'description' => 'Optional change comment.'],
        'includedActions' => ['type' => 'array', 'description' => 'Optional list of change categories to copy.'],
        'excludedActions' => ['type' => 'array', 'description' => 'Optional list of change categories to skip.'],
    ];
}
