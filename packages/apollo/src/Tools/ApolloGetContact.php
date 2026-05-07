<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use RuntimeException;

/**
 * View a saved contact by Apollo contact ID.
 */
class ApolloGetContact extends AbstractApolloTool
{
    protected const NAME = 'apollo_get_contact';

    protected const DESCRIPTION = 'View a saved contact in your Apollo team account by contact ID.';

    protected const PARAMETERS = [
        'contact_id' => ['type' => 'string', 'description' => 'Apollo contact ID.'],
        'id' => ['type' => 'string', 'description' => 'Legacy alias for contact_id.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        $id = $args['contact_id'] ?? $args['id'] ?? null;

        if (empty($id)) {
            throw new RuntimeException('contact_id is required.');
        }

        return $this->service->getContact((string) $id);
    }
}
