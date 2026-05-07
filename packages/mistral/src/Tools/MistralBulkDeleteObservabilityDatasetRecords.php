<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Bulk delete Mistral observability dataset records.
 */
class MistralBulkDeleteObservabilityDatasetRecords extends AbstractMistralTool
{
    protected const NAME = 'mistral_bulk_delete_observability_dataset_records';
    protected const DESCRIPTION = 'Bulk delete Mistral observability dataset records.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/observability/dataset-records/bulk-delete';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
