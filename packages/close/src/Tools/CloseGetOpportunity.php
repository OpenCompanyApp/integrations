<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Fetch a single Close opportunity by ID.
 */
class CloseGetOpportunity extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_get_opportunity';

    protected string $toolDescription = 'Fetch a single Close opportunity by ID.';

    protected string $path = '/opportunity/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close opportunity ID.'],
    ];
}
