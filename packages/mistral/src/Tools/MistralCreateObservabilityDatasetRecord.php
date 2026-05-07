<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a record in a Mistral observability dataset.
 */
class MistralCreateObservabilityDatasetRecord extends AbstractMistralTool
{
    protected const NAME = 'mistral_create_observability_dataset_record';
    protected const DESCRIPTION = 'Create a record in a Mistral observability dataset.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/observability/datasets/{dataset_id}/records';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
