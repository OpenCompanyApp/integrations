<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * Create a saved contact in Apollo.
 */
class ApolloCreateContact extends AbstractApolloTool
{
    protected const NAME = 'apollo_create_contact';

    protected const DESCRIPTION = 'Create a contact in your Apollo team account. Use run_dedupe to avoid duplicates when supported by your plan.';

    protected const PARAMETERS = [
        'first_name' => ['type' => 'string', 'description' => 'Contact first name.'],
        'last_name' => ['type' => 'string', 'description' => 'Contact last name.'],
        'email' => ['type' => 'string', 'description' => 'Contact email address.'],
        'organization_name' => ['type' => 'string', 'description' => 'Employer name.'],
        'title' => ['type' => 'string', 'description' => 'Job title.'],
        'account_id' => ['type' => 'string', 'description' => 'Apollo account ID.'],
        'website_url' => ['type' => 'string', 'description' => 'Employer website URL.'],
        'label_names' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Labels/lists for the contact.'],
        'contact_stage_id' => ['type' => 'string', 'description' => 'Apollo contact stage ID.'],
        'run_dedupe' => ['type' => 'boolean', 'description' => 'Enable Apollo dedupe logic.'],
        'typed_custom_fields' => ['type' => 'object', 'description' => 'Custom field values keyed by Apollo custom field ID.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->createContact($this->filled($args));
    }
}
