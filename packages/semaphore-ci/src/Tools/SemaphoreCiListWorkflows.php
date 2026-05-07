<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * List Semaphore workflows.
 */
class SemaphoreCiListWorkflows extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_list_workflows';
    protected const DESCRIPTION = 'List Semaphore workflows by project_id with optional branch and timestamp filters.';
    protected const METHOD = 'listWorkflows';
    protected const REQUIRED = ['project_id'];
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project UUID.'],
        'branch_name' => ['type' => 'string', 'description' => 'Branch filter.'],
        'created_after' => ['type' => 'integer', 'description' => 'Unix timestamp lower bound.'],
        'created_before' => ['type' => 'integer', 'description' => 'Unix timestamp upper bound.'],
        'query' => ['type' => 'object', 'description' => 'Additional query parameters.'],
    ];
}
