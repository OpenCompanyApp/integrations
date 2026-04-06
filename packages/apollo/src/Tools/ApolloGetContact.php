<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use OpenCompany\Integrations\Apollo\ApolloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve full details for a specific Apollo contact by ID.
 *
 * Returns detailed profile information including employment history,
 * email addresses, phone numbers, and social profiles.
 */
class ApolloGetContact implements Tool
{
    public function __construct(
        private ApolloService $service,
    ) {}

    public function name(): string
    {
        return 'apollo_get_contact';
    }

    public function description(): string
    {
        return 'Retrieve full details for a specific contact in Apollo by their person ID. Returns comprehensive profile data including employment history, emails, phone numbers, and social profiles.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Apollo person ID (e.g., "63f3b1c2XXXXXXXXXXXX").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apollo integration is not configured.');
            }

            $id = $args['id'];
            $result = $this->service->getContact($id);

            $person = $result['person'] ?? $result;

            return ToolResult::success($this->formatPerson($person));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format a person record for display.
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
            'facebook_url' => $person['facebook_url'] ?? null,
            'employment_history' => array_map(
                fn (array $e) => [
                    'title' => $e['title'] ?? null,
                    'organization' => $e['organization_name'] ?? null,
                    'start_date' => $e['started_on'] ?? null,
                    'end_date' => $e['ended_on'] ?? null,
                    'current' => $e['current'] ?? false,
                ],
                $person['employment_history'] ?? [],
            ),
            'city' => $person['city'] ?? null,
            'state' => $person['state'] ?? null,
            'country' => $person['country'] ?? null,
        ];
    }
}
