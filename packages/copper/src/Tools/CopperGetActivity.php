<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Fetch a Copper activity by ID.
 */
class CopperGetActivity extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_get_activity';

    protected string $toolDescription = 'Fetch a Copper activity by ID.';

    protected string $path = '/activities/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper activity ID.'],
    ];
}
