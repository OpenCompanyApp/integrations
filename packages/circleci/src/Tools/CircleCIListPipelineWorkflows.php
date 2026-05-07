<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List workflows for a pipeline.
 */
class CircleCIListPipelineWorkflows extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_pipeline_workflows';

    protected string $toolDescription = 'List workflows for a pipeline.';

    protected string $method = 'GET';

    protected string $path = '/v2/pipeline/{pipeline_id}/workflow';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'pipeline_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Pipeline ID.',
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
    'pipeline_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'page_token' => 'page-token',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
