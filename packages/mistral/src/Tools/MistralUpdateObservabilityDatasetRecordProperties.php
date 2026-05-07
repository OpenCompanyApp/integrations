<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Update properties for a Mistral observability dataset record.
 */
class MistralUpdateObservabilityDatasetRecordProperties extends AbstractMistralTool
{
    protected const NAME = 'mistral_update_observability_dataset_record_properties';
    protected const DESCRIPTION = 'Update properties for a Mistral observability dataset record.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/observability/dataset-records/{dataset_record_id}/properties';
    protected const PATH_PARAMS = ['dataset_record_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['dataset_record_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_record_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
