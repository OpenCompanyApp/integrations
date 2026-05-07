<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Trigger a Buildkite build.
 */
class BuildkiteCreateBuild extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_create_build';
    protected const DESCRIPTION = 'Trigger a new Buildkite build. Provide official build fields in payload, including commit, branch, and message.';
    protected const METHOD = 'createBuild';
    protected const REQUIRED = ['organization', 'pipeline', 'payload'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'Build creation payload such as commit, branch, message, author, env, and meta_data.'],
    ];
}
