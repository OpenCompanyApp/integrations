<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Delete a Copper company.
 */
class CopperDeleteCompany extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_delete_company';

    protected string $toolDescription = 'Delete a company from Copper.';

    protected string $method = 'DELETE';

    protected string $path = '/companies/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper company ID to delete.'],
    ];
}
