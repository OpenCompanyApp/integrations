<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Stop a Semaphore pipeline.
 */
class SemaphoreCiStopPipeline extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_stop_pipeline';
    protected const DESCRIPTION = 'Stop a Semaphore pipeline by setting terminate_request=true.';
    protected const METHOD = 'stopPipeline';
    protected const REQUIRED = ['pipeline_id'];
    protected const PARAMETERS = ['pipeline_id' => ['type' => 'string', 'required' => true, 'description' => 'Pipeline UUID.']];
}
