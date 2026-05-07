<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Cancel a workflow.
 */
class CircleCICancelWorkflow extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_cancel_workflow';

    protected string $toolDescription = 'Cancel a workflow.';

    protected string $method = 'POST';

    protected string $path = '/v2/workflow/{workflow_id}/cancel';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'workflow_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Workflow ID.',
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
];
}
