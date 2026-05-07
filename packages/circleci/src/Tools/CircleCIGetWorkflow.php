<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get details for a workflow.
 */
class CircleCIGetWorkflow extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_workflow';

    protected string $toolDescription = 'Get details for a workflow.';

    protected string $method = 'GET';

    protected string $path = '/v2/workflow/{workflow_id}';

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
