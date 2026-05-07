<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Archive a Buildkite pipeline.
 */
class BuildkiteArchivePipeline extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_archive_pipeline';
    protected const DESCRIPTION = 'Archive a Buildkite pipeline by organization and pipeline slug.';
    protected const METHOD = 'archivePipeline';
    protected const REQUIRED = ['organization', 'pipeline'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
    ];
}
