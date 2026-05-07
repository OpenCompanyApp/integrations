<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Fetch a Copper lead by ID.
 */
class CopperGetLead extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_get_lead';

    protected string $toolDescription = 'Fetch a Copper lead by ID.';

    protected string $path = '/leads/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper lead ID.'],
    ];
}
