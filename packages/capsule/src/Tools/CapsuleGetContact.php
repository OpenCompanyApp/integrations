<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\Integrations\Capsule\CapsuleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * CapsuleGetContact — retrieve a single contact (party) by ID.
 *
 * Returns full contact details including email addresses, phone numbers,
 * and custom field data.
 */
class CapsuleGetContact implements Tool
{
    public function __construct(
        private CapsuleService $service,
    ) {}

    public function name(): string
    {
        return 'capsule_get_contact';
    }

    public function description(): string
    {
        return 'Retrieve a single contact (person or organisation) from Capsule CRM by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The contact (party) ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Capsule CRM integration is not configured.');
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
