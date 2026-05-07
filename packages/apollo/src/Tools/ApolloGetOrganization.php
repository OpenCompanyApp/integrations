<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use RuntimeException;

/**
 * View a saved Apollo account by ID.
 */
class ApolloGetOrganization extends AbstractApolloTool
{
    protected const NAME = 'apollo_get_organization';

    protected const DESCRIPTION = 'View a saved Apollo account by ID. The slug is retained for compatibility with the older organization naming.';

    protected const PARAMETERS = [
        'account_id' => ['type' => 'string', 'description' => 'Apollo account ID.'],
        'id' => ['type' => 'string', 'description' => 'Legacy alias for account_id.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        $id = $args['account_id'] ?? $args['id'] ?? null;

        if (empty($id)) {
            throw new RuntimeException('account_id is required.');
        }

        return $this->service->getOrganization((string) $id);
    }
}
