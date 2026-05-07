<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * List Langfuse v2 datasets.
 */
class LangfuseListDatasets extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_list_datasets';
    protected const DESCRIPTION = 'List Langfuse v2 datasets with pagination.';
    protected const SERVICE_METHOD = 'listDatasets';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['page', 'limit'];
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, starts at 1.'],
        'limit' => ['type' => 'integer', 'description' => 'Items per page.'],
    ];
}
