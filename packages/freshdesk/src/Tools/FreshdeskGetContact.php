<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific customer contact by ID.
 */
class FreshdeskGetContact implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_get_contact';
    }

    public function description(): string
    {
        return 'Get full details of a specific customer contact including email, phone, company, and custom fields.';
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'integer', 'required' => true, 'description' => 'The contact ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshdesk integration is not configured.');
            }

            $contactId = (int) ($args['contact_id'] ?? 0);
            if ($contactId <= 0) {
                return ToolResult::error('contact_id is required and must be a positive integer.');
            }

            $result = $this->service->getContact($contactId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
