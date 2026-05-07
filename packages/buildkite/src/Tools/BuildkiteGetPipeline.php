<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Get one Buildkite pipeline.
 */
class BuildkiteGetPipeline extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_get_pipeline';
    protected const DESCRIPTION = 'Get a Buildkite pipeline by organization and pipeline slug.';
    protected const METHOD = 'getPipeline';
    protected const REQUIRED = ['organization', 'pipeline'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
    ];
}
