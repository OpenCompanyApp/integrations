<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * List Langfuse v2 prompts.
 */
class LangfuseListPrompts extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_list_prompts';
    protected const DESCRIPTION = 'List Langfuse v2 prompts with pagination, name, tag, and label filters.';
    protected const SERVICE_METHOD = 'listPrompts';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['page', 'limit', 'name', 'tag', 'label'];
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, starts at 1.'],
        'limit' => ['type' => 'integer', 'description' => 'Items per page.'],
        'name' => ['type' => 'string', 'description' => 'Filter by prompt name.'],
        'tag' => ['type' => 'string', 'description' => 'Filter by prompt tag.'],
        'label' => ['type' => 'string', 'description' => 'Filter by prompt label.'],
    ];
}
