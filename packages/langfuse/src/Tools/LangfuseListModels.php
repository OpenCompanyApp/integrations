<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * List Langfuse model definitions.
 */
class LangfuseListModels extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_list_models';
    protected const DESCRIPTION = 'List Langfuse model definitions with pagination.';
    protected const SERVICE_METHOD = 'listModels';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['page', 'limit'];
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, starts at 1.'],
        'limit' => ['type' => 'integer', 'description' => 'Items per page.'],
    ];
}
