<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get compiled configuration for a pipeline.
 */
class CircleCIGetPipelineConfig extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_pipeline_config';

    protected string $toolDescription = 'Get compiled configuration for a pipeline.';

    protected string $method = 'GET';

    protected string $path = '/v2/pipeline/{pipeline_id}/config';

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
