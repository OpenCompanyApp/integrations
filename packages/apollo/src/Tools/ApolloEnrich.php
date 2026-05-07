<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * Enrich one person using Apollo's People Enrichment endpoint.
 */
class ApolloEnrich extends AbstractApolloTool
{
    protected const NAME = 'apollo_enrich';

    protected const DESCRIPTION = 'Enrich one person by email, name, Apollo person ID, LinkedIn URL, organization name, or domain. Phone and personal-email reveal options may consume credits and phone reveal requires a webhook URL.';

    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'description' => 'Person email address.'],
        'name' => ['type' => 'string', 'description' => 'Full name.'],
        'first_name' => ['type' => 'string', 'description' => 'First name.'],
        'last_name' => ['type' => 'string', 'description' => 'Last name.'],
        'id' => ['type' => 'string', 'description' => 'Apollo person ID.'],
        'linkedin_url' => ['type' => 'string', 'description' => 'LinkedIn profile URL.'],
        'domain' => ['type' => 'string', 'description' => 'Company domain.'],
        'organization_name' => ['type' => 'string', 'description' => 'Employer name.'],
        'reveal_personal_emails' => ['type' => 'boolean', 'description' => 'Reveal personal emails when available.'],
        'reveal_phone_number' => ['type' => 'boolean', 'description' => 'Reveal phone numbers asynchronously via webhook.'],
        'webhook_url' => ['type' => 'string', 'description' => 'HTTPS webhook URL required when reveal_phone_number is true.'],
        'filters' => ['type' => 'object', 'description' => 'Additional documented People Enrichment parameters.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->enrichPerson($this->filters($args));
    }
}
