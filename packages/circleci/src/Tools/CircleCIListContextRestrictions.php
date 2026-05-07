<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List context restrictions.
 */
class CircleCIListContextRestrictions extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_context_restrictions';

    protected string $toolDescription = 'List context restrictions.';

    protected string $method = 'GET';

    protected string $path = '/v2/context/{context_id}/restrictions';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'context_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Context ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'context_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
