<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral observability dataset.
 */
class MistralDeleteObservabilityDataset extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_observability_dataset';
    protected const DESCRIPTION = 'Delete a Mistral observability dataset.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/observability/datasets/{dataset_id}';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
