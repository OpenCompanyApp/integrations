<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List records in a Mistral observability dataset.
 */
class MistralListObservabilityDatasetRecords extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_observability_dataset_records';
    protected const DESCRIPTION = 'List records in a Mistral observability dataset.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/datasets/{dataset_id}/records';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
