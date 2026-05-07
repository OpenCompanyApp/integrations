<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a Mistral observability dataset import task.
 */
class MistralGetObservabilityDatasetTask extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_observability_dataset_task';
    protected const DESCRIPTION = 'Get a Mistral observability dataset import task.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/datasets/{dataset_id}/tasks/{task_id}';
    protected const PATH_PARAMS = ['dataset_id', 'task_id'];
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_id.'], 'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral task_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
