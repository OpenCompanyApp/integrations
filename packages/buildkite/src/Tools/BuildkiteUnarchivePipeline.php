<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Unarchive a Buildkite pipeline.
 */
class BuildkiteUnarchivePipeline extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_unarchive_pipeline';
    protected const DESCRIPTION = 'Unarchive a Buildkite pipeline by organization and pipeline slug.';
    protected const METHOD = 'unarchivePipeline';
    protected const REQUIRED = ['organization', 'pipeline'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
    ];
}
