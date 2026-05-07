<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Continue a setup workflow pipeline with generated configuration.
 */
class CircleCIContinuePipeline extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_continue_pipeline';

    protected string $toolDescription = 'Continue a setup workflow pipeline with generated configuration.';

    protected string $method = 'POST';

    protected string $path = '/v2/pipeline/continue';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'continuation_key' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Continuation key from the setup workflow.',
    ],
    'configuration' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Generated CircleCI configuration.',
    ],
    'parameters' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Pipeline parameters.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'continuation_key',
    'configuration',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'continuation_key' => 'continuation-key',
    'configuration',
    'parameters',
];
}
