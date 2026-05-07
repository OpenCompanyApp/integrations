<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List jobs for a workflow.
 */
class CircleCIListWorkflowJobs extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_workflow_jobs';

    protected string $toolDescription = 'List jobs for a workflow.';

    protected string $method = 'GET';

    protected string $path = '/v2/workflow/{workflow_id}/job';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'workflow_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Workflow ID.',
    ],
    'page_token' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Pagination token from the previous response.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum records to return when supported.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'workflow_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'page_token' => 'page-token',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
