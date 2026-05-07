<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Rerun a workflow.
 */
class CircleCIRerunWorkflow extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_rerun_workflow';

    protected string $toolDescription = 'Rerun a workflow.';

    protected string $method = 'POST';

    protected string $path = '/v2/workflow/{workflow_id}/rerun';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'workflow_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Workflow ID.',
    ],
    'enable_ssh' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Enable SSH for rerun jobs.',
    ],
    'from_failed' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Rerun from failed jobs only.',
    ],
    'jobs' => [
        'type' => 'array',
        'required' => false,
        'description' => 'Workflow job IDs to rerun.',
    ],
    'sparse_tree' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Rerun sparse dependency tree.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'workflow_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'enable_ssh',
    'from_failed',
    'jobs',
    'sparse_tree',
];
}
