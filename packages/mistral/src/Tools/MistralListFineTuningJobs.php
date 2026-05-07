<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral fine-tuning jobs.
 */
class MistralListFineTuningJobs extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_fine_tuning_jobs';
    protected const DESCRIPTION = 'List Mistral fine-tuning jobs.';
    protected const PATH = '/v1/fine_tuning/jobs';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional fine-tuning job list query parameters.']];
}
