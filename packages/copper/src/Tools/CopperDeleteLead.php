<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Delete a Copper lead.
 */
class CopperDeleteLead extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_delete_lead';

    protected string $toolDescription = 'Delete a lead from Copper.';

    protected string $method = 'DELETE';

    protected string $path = '/leads/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper lead ID to delete.'],
    ];
}
