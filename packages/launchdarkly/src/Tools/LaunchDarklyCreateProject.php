<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Create a LaunchDarkly project.
 */
class LaunchDarklyCreateProject extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_create_project';
    protected const DESCRIPTION = 'Create a LaunchDarkly project with optional default environments, tags, and client-side defaults.';
    protected const METHOD = 'POST';
    protected const PATH = '/projects';
    protected const REQUIRED = ['name', 'key'];
    protected const BODY_KEYS = ['name', 'key', 'includeInSnippetByDefault', 'defaultClientSideAvailability', 'tags', 'environments', 'namingConvention'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Human-readable project name.'],
        'key' => ['type' => 'string', 'required' => true, 'description' => 'Unique project key.'],
        'includeInSnippetByDefault' => ['type' => 'boolean', 'description' => 'Whether new flags are client-side available by default for legacy snippets.'],
        'defaultClientSideAvailability' => ['type' => 'object', 'description' => 'Default client-side SDK availability for new flags.'],
        'tags' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Project tags.'],
        'environments' => ['type' => 'array', 'description' => 'Optional environment objects to create with the project.'],
        'namingConvention' => ['type' => 'object', 'description' => 'Optional flag-key naming convention.'],
        'body' => ['type' => 'object', 'description' => 'Additional project fields accepted by LaunchDarkly.'],
    ];
}
