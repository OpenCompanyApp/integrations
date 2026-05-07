<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Delete a Copper project.
 */
class CopperDeleteProject extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_delete_project';

    protected string $toolDescription = 'Delete a project from Copper.';

    protected string $method = 'DELETE';

    protected string $path = '/projects/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper project ID to delete.'],
    ];
}
