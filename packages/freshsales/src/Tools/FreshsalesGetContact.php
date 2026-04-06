<?php

namespace OpenCompany\Integrations\Freshsales\Tools;

use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Freshsales contact by ID.
 *
 * Retrieves full details for a specific contact, including custom fields,
 * associated deals, activities, and notes.
 */
class FreshsalesGetContact implements Tool
{
    public function __construct(
        private FreshsalesService $service,
    ) {}

    public function name(): string
    {
        return 'freshsales_get_contact';
    }

    public function description(): string
    {
        return 'Get full details for a specific Freshsales contact by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The contact ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshsales integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->getContact((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
