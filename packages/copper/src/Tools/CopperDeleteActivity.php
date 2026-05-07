<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Delete a Copper activity.
 */
class CopperDeleteActivity extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_delete_activity';

    protected string $toolDescription = 'Delete an activity from Copper.';

    protected string $method = 'DELETE';

    protected string $path = '/activities/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper activity ID to delete.'],
    ];
}
