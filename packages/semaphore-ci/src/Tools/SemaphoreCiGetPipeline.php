<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Get one Semaphore pipeline.
 */
class SemaphoreCiGetPipeline extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_get_pipeline';
    protected const DESCRIPTION = 'Get a Semaphore pipeline by pipeline_id. Set detailed=true only when block and job details are needed.';
    protected const METHOD = 'getPipeline';
    protected const REQUIRED = ['pipeline_id'];
    protected const PARAMETERS = ['pipeline_id' => ['type' => 'string', 'required' => true, 'description' => 'Pipeline UUID.'], 'detailed' => ['type' => 'boolean', 'description' => 'Include detailed blocks and jobs.']];
}
