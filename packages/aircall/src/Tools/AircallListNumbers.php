<?php

namespace OpenCompany\Integrations\Aircall\Tools;

use OpenCompany\Integrations\Aircall\AircallService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing phone numbers from the Aircall API.
 *
 * Returns all phone numbers in the Aircall account with their details
 * including the number, country, type, and associated users/teams.
 *
 * @see https://developer.aircall.io/api-references/#list-numbers
 */
class AircallListNumbers implements Tool
{
    /**
     * Create a new AircallListNumbers tool instance.
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
        return 'aircall_list_numbers';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List all phone numbers in the Aircall account. Returns number details including the phone number, country, type, and assigned users.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list numbers tool.
     *
     * @param  array  $args  No parameters required.
     * @return ToolResult The result containing number records or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Aircall integration is not configured.');
            }

            $result = $this->service->listNumbers();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
