<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Patch a Mistral observability dataset.
 */
class MistralUpdateObservabilityDataset extends AbstractMistralTool
{
    protected const NAME = 'mistral_update_observability_dataset';
    protected const DESCRIPTION = 'Patch a Mistral observability dataset.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/observability/datasets/{dataset_id}';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
