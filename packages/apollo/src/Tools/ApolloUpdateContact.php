<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use RuntimeException;

/**
 * Update a saved Apollo contact.
 */
class ApolloUpdateContact extends AbstractApolloTool
{
    protected const NAME = 'apollo_update_contact';

    protected const DESCRIPTION = 'Update a saved Apollo contact by contact ID.';

    protected const PARAMETERS = [
        'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Apollo contact ID.'],
        'first_name' => ['type' => 'string', 'description' => 'Contact first name.'],
        'last_name' => ['type' => 'string', 'description' => 'Contact last name.'],
        'email' => ['type' => 'string', 'description' => 'Contact email address.'],
        'organization_name' => ['type' => 'string', 'description' => 'Employer name.'],
        'title' => ['type' => 'string', 'description' => 'Job title.'],
        'account_id' => ['type' => 'string', 'description' => 'Apollo account ID.'],
        'label_names' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Replacement labels/lists for the contact.'],
        'contact_stage_id' => ['type' => 'string', 'description' => 'Apollo contact stage ID.'],
        'typed_custom_fields' => ['type' => 'object', 'description' => 'Custom field values keyed by Apollo custom field ID.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        if (empty($args['contact_id'])) {
            throw new RuntimeException('contact_id is required.');
        }

        $contactId = (string) $args['contact_id'];
        unset($args['contact_id']);

        return $this->service->updateContact($contactId, $this->filled($args));
    }
}
