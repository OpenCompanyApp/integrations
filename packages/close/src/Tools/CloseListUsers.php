<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * List Close users in the organization.
 */
class CloseListUsers extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_list_users';

    protected string $toolDescription = 'List Close users in the authenticated organization.';

    protected string $path = '/user/';

    /** @var list<string> */
    protected array $queryParams = ['query', '_limit', '_skip'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'query' => ['type' => 'string', 'description' => 'Optional user search query.'],
        '_limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return.'],
        '_skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
    ];
}
