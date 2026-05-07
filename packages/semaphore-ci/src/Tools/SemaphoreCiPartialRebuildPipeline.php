<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Rebuild failed blocks in a Semaphore pipeline.
 */
class SemaphoreCiPartialRebuildPipeline extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_partial_rebuild_pipeline';
    protected const DESCRIPTION = 'Rebuild failed blocks in a Semaphore pipeline. Payload must include request_token.';
    protected const METHOD = 'partialRebuildPipeline';
    protected const REQUIRED = ['pipeline_id', 'payload'];
    protected const PARAMETERS = ['pipeline_id' => ['type' => 'string', 'required' => true, 'description' => 'Pipeline UUID.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Partial rebuild payload with request_token.']];
}
