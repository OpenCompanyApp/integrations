<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use OpenCompany\Integrations\Apollo\ApolloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Enrich a contact by matching on email and/or name.
 *
 * Uses the Apollo people match endpoint to find and enrich a person's
 * profile data based on known information like email or full name.
 */
class ApolloEnrich implements Tool
{
    public function __construct(
        private ApolloService $service,
    ) {}

    public function name(): string
    {
        return 'apollo_enrich';
    }

    public function description(): string
    {
        return 'Enrich a contact by matching on email address and/or name. Returns enriched profile data including title, company, social profiles, and contact details. Provide at least an email or a name.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'description' => 'Email address to match (e.g., "john@example.com").'],
            'name' => ['type' => 'string', 'description' => 'Full name to match (e.g., "John Smith").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apollo integration is not configured.');
            }

            $email = $args['email'] ?? null;
            $name = $args['name'] ?? null;

            if (empty($email) && empty($name)) {
                return ToolResult::error('At least one of "email" or "name" is required.');
            }

            $result = $this->service->enrich($email, $name);

            $person = $result['person'] ?? $result;

            if (empty($person) || (isset($person['id']) === false && isset($person['email']) === false)) {
                return ToolResult::success([
                    'found' => false,
                    'message' => 'No matching contact found.',
                ]);
            }

            return ToolResult::success([
                'found' => true,
                'person' => $this->formatPerson($person),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format an enriched person record for display.
     *
     * @param  array<string, mixed>  $person  Raw person data from the API.
     * @return array<string, mixed> Formatted person data.
     */
    private function formatPerson(array $person): array
    {
        return [
            'id' => $person['id'] ?? null,
            'first_name' => $person['first_name'] ?? null,
            'last_name' => $person['last_name'] ?? null,
            'name' => trim(($person['first_name'] ?? '') . ' ' . ($person['last_name'] ?? '')),
            'email' => $person['email'] ?? null,
            'title' => $person['title'] ?? null,
            'organization' => $person['organization']['name'] ?? $person['organization_name'] ?? null,
            'organization_id' => $person['organization_id'] ?? null,
            'phone_numbers' => array_map(
                fn (array $p) => $p['raw_number'] ?? $p['sanitized_number'] ?? null,
                $person['phone_numbers'] ?? [],
            ),
            'linkedin_url' => $person['linkedin_url'] ?? null,
            'twitter_url' => $person['twitter_url'] ?? null,
            'github_url' => $person['github_url'] ?? null,
            'city' => $person['city'] ?? null,
            'state' => $person['state'] ?? null,
            'country' => $person['country'] ?? null,
        ];
    }
}
