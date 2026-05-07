<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Fetch a Copper user by ID.
 */
class CopperGetUser extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_get_user';

    protected string $toolDescription = 'Fetch a Copper user by ID.';

    protected string $path = '/users/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper user ID.'],
    ];
}
