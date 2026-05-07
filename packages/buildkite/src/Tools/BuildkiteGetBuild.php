<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Get one Buildkite build.
 */
class BuildkiteGetBuild extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_get_build';
    protected const DESCRIPTION = 'Get a Buildkite build by build number. Buildkite requires the build number, not the build UUID.';
    protected const METHOD = 'getBuild';
    protected const REQUIRED = ['organization', 'pipeline', 'number'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
        'number' => ['type' => 'integer', 'required' => true, 'description' => 'Build number, not build UUID.'],
    ];
}
