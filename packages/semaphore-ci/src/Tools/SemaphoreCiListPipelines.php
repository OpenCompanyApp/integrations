<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * List Semaphore pipelines.
 */
class SemaphoreCiListPipelines extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_list_pipelines';
    protected const DESCRIPTION = 'List Semaphore pipelines by project_id or wf_id with optional branch, YAML path, and timestamp filters.';
    protected const METHOD = 'listPipelines';
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'description' => 'Project UUID. Required unless wf_id is present.'],
        'wf_id' => ['type' => 'string', 'description' => 'Workflow UUID. Required unless project_id is present.'],
        'branch_name' => ['type' => 'string', 'description' => 'Branch filter.'],
        'yml_file_path' => ['type' => 'string', 'description' => 'Pipeline YAML file path.'],
        'query' => ['type' => 'object', 'description' => 'Additional query parameters.'],
    ];
}
