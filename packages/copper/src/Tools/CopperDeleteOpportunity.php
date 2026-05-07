<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Delete a Copper opportunity.
 */
class CopperDeleteOpportunity extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_delete_opportunity';

    protected string $toolDescription = 'Delete an opportunity from Copper.';

    protected string $method = 'DELETE';

    protected string $path = '/opportunities/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper opportunity ID to delete.'],
    ];
}
