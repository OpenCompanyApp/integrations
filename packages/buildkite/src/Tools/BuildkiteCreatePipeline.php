<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Create a Buildkite pipeline.
 */
class BuildkiteCreatePipeline extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_create_pipeline';
    protected const DESCRIPTION = 'Create a Buildkite pipeline. Provide official pipeline fields in payload, including name and repository.';
    protected const METHOD = 'createPipeline';
    protected const REQUIRED = ['organization', 'payload'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'Buildkite pipeline creation payload.'],
    ];
}
