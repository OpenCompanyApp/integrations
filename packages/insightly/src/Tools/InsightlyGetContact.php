<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Contact
 *
 * Retrieves a single contact from Insightly CRM by its ID.
 *
 * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/GetEntity
 */
class InsightlyGetContact implements Tool
{
    /**
     * Create a new InsightlyGetContact tool instance.
     *
     * @param  InsightlyService  $service  The Insightly API service.
     */
    public function __construct(
        private InsightlyService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'insightly_get_contact';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Get detailed information about a single Insightly contact by ID. Returns all contact fields including addresses, emails, phones, and linked organizations.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Insightly contact ID.'],
        ];
    }

    /**
     * Execute the get contact tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing 'id'.
     * @return ToolResult The contact record or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Insightly integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getContact((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
