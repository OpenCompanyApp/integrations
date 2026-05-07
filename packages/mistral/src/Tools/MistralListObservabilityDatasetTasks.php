<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral observability dataset import tasks.
 */
class MistralListObservabilityDatasetTasks extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_observability_dataset_tasks';
    protected const DESCRIPTION = 'List Mistral observability dataset import tasks.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/datasets/{dataset_id}/tasks';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
