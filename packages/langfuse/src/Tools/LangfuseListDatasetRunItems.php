<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * List Langfuse dataset run items.
 */
class LangfuseListDatasetRunItems extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_list_dataset_run_items';
    protected const DESCRIPTION = 'List Langfuse dataset run items with dataset, run, and pagination filters.';
    protected const SERVICE_METHOD = 'listDatasetRunItems';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['page', 'limit', 'datasetName', 'runName'];
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, starts at 1.'],
        'limit' => ['type' => 'integer', 'description' => 'Items per page.'],
        'datasetName' => ['type' => 'string', 'description' => 'Filter by dataset name.'],
        'runName' => ['type' => 'string', 'description' => 'Filter by run name.'],
    ];
}
