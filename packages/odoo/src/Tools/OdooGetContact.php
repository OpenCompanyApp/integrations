<?php

namespace OpenCompany\Integrations\Odoo\Tools;

use OpenCompany\Integrations\Odoo\OdooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get a single contact from Odoo by ID.
 *
 * Retrieves the full details of a specific contact (res.partner)
 * including name, email, phone, address, and company information.
 */
class OdooGetContact implements Tool
{
    /**
     * @param  OdooService  $service  The Odoo service instance for making API calls.
     */
    public function __construct(
        private OdooService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'odoo_get_contact';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get full details of a specific Odoo contact by ID. Returns name, email, phone, address, and all associated data.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Odoo contact ID.'],
        ];
    }

    /**
     * Execute the tool — fetch a single contact by ID from Odoo.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Odoo integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->getContact((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
