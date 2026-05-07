<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * List Langfuse dataset items.
 */
class LangfuseListDatasetItems extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_list_dataset_items';
    protected const DESCRIPTION = 'List Langfuse dataset items with dataset, source trace/observation, and pagination filters.';
    protected const SERVICE_METHOD = 'listDatasetItems';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['page', 'limit', 'datasetName', 'sourceTraceId', 'sourceObservationId'];
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, starts at 1.'],
        'limit' => ['type' => 'integer', 'description' => 'Items per page.'],
        'datasetName' => ['type' => 'string', 'description' => 'Filter by dataset name.'],
        'sourceTraceId' => ['type' => 'string', 'description' => 'Filter by source trace ID.'],
        'sourceObservationId' => ['type' => 'string', 'description' => 'Filter by source observation ID.'],
    ];
}
