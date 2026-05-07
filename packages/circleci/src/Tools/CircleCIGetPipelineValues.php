<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get pipeline parameter values for a pipeline.
 */
class CircleCIGetPipelineValues extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_pipeline_values';

    protected string $toolDescription = 'Get pipeline parameter values for a pipeline.';

    protected string $method = 'GET';

    protected string $path = '/v2/pipeline/{pipeline_id}/values';

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
