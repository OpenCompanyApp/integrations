<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a Mistral observability dataset.
 */
class MistralGetObservabilityDataset extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_observability_dataset';
    protected const DESCRIPTION = 'Get a Mistral observability dataset.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/datasets/{dataset_id}';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
