<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Approve a workflow approval job.
 */
class CircleCIApproveWorkflowJob extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_approve_workflow_job';

    protected string $toolDescription = 'Approve a workflow approval job.';

    protected string $method = 'POST';

    protected string $path = '/v2/workflow/{workflow_id}/approve/{approval_request_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'workflow_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Workflow ID.',
    ],
    'approval_request_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Approval request ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'workflow_id',
    'approval_request_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
