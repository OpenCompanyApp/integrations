<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Import observability dataset records from another dataset.
 */
class MistralImportObservabilityDatasetFromDataset extends AbstractMistralTool
{
    protected const NAME = 'mistral_import_observability_dataset_from_dataset';
    protected const DESCRIPTION = 'Import observability dataset records from another dataset.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/observability/datasets/{dataset_id}/imports/from-dataset';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
