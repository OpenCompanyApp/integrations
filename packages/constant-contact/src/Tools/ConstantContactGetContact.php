<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Contact
 *
 * Retrieves detailed information for a single Constant Contact contact by ID.
 */
class ConstantContactGetContact implements Tool
{
    /**
     * @param  ConstantContactService  $service  The Constant Contact API service.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * The unique tool slug.
     */
    public function name(): string
    {
        return 'constantcontact_get_contact';
    }

    /**
     * Human-readable description shown in tool catalogs and generated docs.
     */
    public function description(): string
    {
        return 'Get detailed information for a single Constant Contact contact by ID, including email, name, phone, address, and list memberships.';
    }

    /**
     * Parameter definitions for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'contact_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Constant Contact contact ID.',
            ],
        ];
    }

    /**
     * Execute the get contact tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id).
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            $contactId = $args['contact_id'] ?? '';
            if (empty($contactId)) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->getContact($contactId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
