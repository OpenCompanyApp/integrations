<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Create a LaunchDarkly feature flag.
 */
class LaunchDarklyCreateFeatureFlag extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_create_feature_flag';
    protected const DESCRIPTION = 'Create a feature flag in a LaunchDarkly project.';
    protected const METHOD = 'POST';
    protected const PATH = '/flags/{project_key}';
    protected const REQUIRED = ['project_key', 'key'];
    protected const BODY_KEYS = ['key', 'name', 'kind', 'description', 'variations', 'temporary', 'tags', 'clientSideAvailability', 'defaults', 'includeInSnippet', 'maintainerId', 'customProperties', 'purpose', 'migrationSettings'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'key' => ['type' => 'string', 'required' => true, 'description' => 'Unique feature flag key.'],
        'name' => ['type' => 'string', 'description' => 'Human-readable flag name.'],
        'kind' => ['type' => 'string', 'enum' => ['boolean', 'multivariate'], 'description' => 'Flag kind. Defaults to boolean upstream.'],
        'description' => ['type' => 'string', 'description' => 'Flag description.'],
        'variations' => ['type' => 'array', 'description' => 'Variation objects for multivariate flags.'],
        'temporary' => ['type' => 'boolean', 'description' => 'Whether the flag is temporary.'],
        'tags' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Flag tags.'],
        'clientSideAvailability' => ['type' => 'object', 'description' => 'Client-side SDK availability.'],
        'defaults' => ['type' => 'object', 'description' => 'Default on/off variation indices.'],
        'body' => ['type' => 'object', 'description' => 'Additional flag fields accepted by LaunchDarkly.'],
    ];
}
