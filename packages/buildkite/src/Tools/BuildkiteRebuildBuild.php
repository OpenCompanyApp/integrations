<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Rebuild a Buildkite build.
 */
class BuildkiteRebuildBuild extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_rebuild_build';
    protected const DESCRIPTION = 'Rebuild a Buildkite build by build number.';
    protected const METHOD = 'rebuildBuild';
    protected const REQUIRED = ['organization', 'pipeline', 'number'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
        'number' => ['type' => 'integer', 'required' => true, 'description' => 'Build number, not build UUID.'],
    ];
}
