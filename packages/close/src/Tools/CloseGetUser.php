<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Fetch a single Close user by ID.
 */
class CloseGetUser extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_get_user';

    protected string $toolDescription = 'Fetch a single Close user by ID.';

    protected string $path = '/user/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close user ID.'],
    ];
}
