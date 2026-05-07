<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Export a Mistral observability dataset to JSONL.
 */
class MistralExportObservabilityDatasetJsonl extends AbstractMistralTool
{
    protected const NAME = 'mistral_export_observability_dataset_jsonl';
    protected const DESCRIPTION = 'Export a Mistral observability dataset to JSONL.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/datasets/{dataset_id}/exports/to-jsonl';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral dataset_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
