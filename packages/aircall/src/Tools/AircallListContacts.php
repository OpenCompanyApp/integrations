<?php

namespace OpenCompany\Integrations\Aircall\Tools;

use OpenCompany\Integrations\Aircall\AircallService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing contacts from the Aircall API.
 *
 * Supports search queries and pagination. Returns contact details including
 * name, company, phone numbers, emails, and associated call statistics.
 *
 * @see https://developer.aircall.io/api-references/#list-contacts
 */
class AircallListContacts implements Tool
{
    /**
     * Create a new AircallListContacts tool instance.
     *
     * @param  AircallService  $service  The Aircall API service instance.
     */
    public function __construct(
        private AircallService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'aircall_list_contacts';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List contacts from Aircall with optional search and pagination. Search by name, phone number, or email. Returns contact details including phone numbers and emails.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 50).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'order' => ['type' => 'string', 'description' => 'Sort order: "asc" or "desc" (default: "desc").'],
            'q' => ['type' => 'string', 'description' => 'Search query — search contacts by name, phone number, or email.'],
        ];
    }

    /**
     * Execute the list contacts tool.
     *
     * @param  array  $args  The tool arguments matching the defined parameters.
     * @return ToolResult The result containing contact records or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Aircall integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['per_page', 'page', 'order', 'q'];

            foreach ($filterKeys as $key) {
                if (isset($args[$key])) {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listContacts($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
