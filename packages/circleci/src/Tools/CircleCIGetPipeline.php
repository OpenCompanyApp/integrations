<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get details for a pipeline by ID.
 */
class CircleCIGetPipeline extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_pipeline';

    protected string $toolDescription = 'Get details for a pipeline by ID.';

    protected string $method = 'GET';

    protected string $path = '/v2/pipeline/{pipeline_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'pipeline_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Pipeline ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'pipeline_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
