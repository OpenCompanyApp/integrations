<?php

namespace OpenCompany\Integrations\Actively\Tools;

use OpenCompany\Integrations\Actively\ActivelyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single contact by ID from Actively.
 *
 * Returns full contact details including name, email, phone number,
 * organization membership, and any custom fields.
 */
class ActivelyGetContact implements Tool
{
    public function __construct(
        private ActivelyService $service,
    ) {}

    public function name(): string
    {
        return 'actively_get_contact';
    }

    public function description(): string
    {
        return 'Get details of a specific contact in Actively. Returns the contact\'s name, email, phone, and all associated metadata.';
    }

    public function parameters(): array
    {
        return [
            'org_id' => ['type' => 'string', 'required' => true, 'description' => 'The organization UUID.'],
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'The contact UUID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Actively integration is not configured.');
            }

            $result = $this->service->getContact($args['org_id'], $args['contact_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
