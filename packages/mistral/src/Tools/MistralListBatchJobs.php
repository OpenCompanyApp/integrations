<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral batch jobs.
 */
class MistralListBatchJobs extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_batch_jobs';
    protected const DESCRIPTION = 'List Mistral batch jobs.';
    protected const PATH = '/v1/batch/jobs';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional batch job list query parameters.']];
}
