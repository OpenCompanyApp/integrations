<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Delete a context restriction.
 */
class CircleCIDeleteContextRestriction extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_delete_context_restriction';

    protected string $toolDescription = 'Delete a context restriction.';

    protected string $method = 'DELETE';

    protected string $path = '/v2/context/{context_id}/restriction/{restriction_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'context_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Context ID.',
    ],
    'restriction_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Restriction ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'context_id',
    'restriction_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
