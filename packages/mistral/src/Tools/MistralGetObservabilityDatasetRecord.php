<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a Mistral observability dataset record.
 */
class MistralGetObservabilityDatasetRecord extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_observability_dataset_record';
    protected const DESCRIPTION = 'Get a Mistral observability dataset record.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/dataset-records/{dataset_record_id}';
    protected const PATH_PARAMS = ['dataset_record_id'];
    protected const PARAMETERS = ['dataset_record_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_record_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
