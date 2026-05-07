<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

/**
 * Update a Buildkite pipeline.
 */
class BuildkiteUpdatePipeline extends AbstractBuildkiteTool
{
    protected const NAME = 'buildkite_update_pipeline';
    protected const DESCRIPTION = 'Update a Buildkite pipeline. Provide partial official pipeline fields in payload.';
    protected const METHOD = 'updatePipeline';
    protected const REQUIRED = ['organization', 'pipeline', 'payload'];
    protected const PARAMETERS = [
        'organization' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite organization slug.'],
        'pipeline' => ['type' => 'string', 'required' => true, 'description' => 'Buildkite pipeline slug.'],
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'Buildkite pipeline update payload.'],
    ];
}
