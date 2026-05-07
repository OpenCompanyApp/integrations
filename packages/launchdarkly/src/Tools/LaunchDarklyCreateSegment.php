<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Create a LaunchDarkly segment.
 */
class LaunchDarklyCreateSegment extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_create_segment';
    protected const DESCRIPTION = 'Create a LaunchDarkly segment in a project environment.';
    protected const METHOD = 'POST';
    protected const PATH = '/segments/{project_key}/{environment_key}';
    protected const REQUIRED = ['project_key', 'environment_key', 'name', 'key'];
    protected const BODY_KEYS = ['name', 'key', 'description', 'tags', 'unbounded', 'unboundedContextKind'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'environment_key' => ['type' => 'string', 'required' => true, 'description' => 'Environment key.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Human-readable segment name.'],
        'key' => ['type' => 'string', 'required' => true, 'description' => 'Unique segment key.'],
        'description' => ['type' => 'string', 'description' => 'Segment description.'],
        'tags' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Segment tags.'],
        'unbounded' => ['type' => 'boolean', 'description' => 'Create a big segment. Enterprise plan may be required.'],
        'unboundedContextKind' => ['type' => 'string', 'description' => 'Targeted context kind for big segments.'],
        'body' => ['type' => 'object', 'description' => 'Additional segment fields accepted by LaunchDarkly.'],
    ];
}
