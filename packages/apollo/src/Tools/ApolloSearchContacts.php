<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use OpenCompany\Integrations\Apollo\ApolloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for contacts (people) in Apollo by name, email, or keyword.
 *
 * Uses the mixed people search endpoint which returns contacts from both
 * your saved contacts and the Apollo database.
 */
class ApolloSearchContacts implements Tool
{
    public function __construct(
        private ApolloService $service,
    ) {}

    public function name(): string
    {
        return 'apollo_search_contacts';
    }

    public function description(): string
    {
        return 'Search for people in Apollo by name, email, or keyword. Returns a paginated list of contacts with profile details including name, title, company, email, phone, and social profiles.';
    }

    public function parameters(): array
    {
        return [
            'q' => ['type' => 'string', 'required' => true, 'description' => 'Search query — a name, email address, company name, or keyword.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 25, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apollo integration is not configured.');
            }

            $q = $args['q'];
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;

            $result = $this->service->searchContacts($q, $page, $perPage);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the search response for display.
     *
     * @param  array<string, mixed>  $result  Raw API response.
     * @return array<string, mixed> Formatted response.
     */
    private function formatResponse(array $result): array
    {
        $contacts = $result['contacts'] ?? $result['people'] ?? [];
        $pagination = $result['pagination'] ?? [];

        $formatted = array_map(function (array $contact): array {
            return [
                'id' => $contact['id'] ?? null,
                'name' => ($contact['first_name'] ?? '') . ' ' . ($contact['last_name'] ?? ''),
                'email' => $contact['email'] ?? null,
                'title' => $contact['title'] ?? null,
                'organization' => $contact['organization']['name'] ?? $contact['organization_name'] ?? null,
                'phone' => $contact['phone_numbers'][0]['raw_number'] ?? $contact['phone'] ?? null,
                'linkedin_url' => $contact['linkedin_url'] ?? null,
            ];
        }, $contacts);

        return [
            'contacts' => $formatted,
            'total' => $pagination['total_entries'] ?? count($formatted),
            'page' => $pagination['page'] ?? $page,
            'per_page' => $pagination['per_page'] ?? 25,
            'total_pages' => $pagination['total_pages'] ?? null,
        ];
    }
}
