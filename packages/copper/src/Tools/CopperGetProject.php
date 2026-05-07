<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Fetch a Copper project by ID.
 */
class CopperGetProject extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_get_project';

    protected string $toolDescription = 'Fetch a Copper project by ID.';

    protected string $path = '/projects/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper project ID.'],
    ];
}
