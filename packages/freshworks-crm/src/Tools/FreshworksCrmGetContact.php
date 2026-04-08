<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

use OpenCompany\Integrations\FreshworksCrm\FreshworksCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshworksCrmGetContact implements Tool
{
    public function __construct(
        private FreshworksCrmService $service,
    ) {}

    public function name(): string
    {
        return 'freshworks_crm_get_contact';
    }

    public function description(): string
    {
        return 'Get a single contact from Freshworks CRM by ID. Returns full contact details including custom fields.';
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
                return ToolResult::error('Freshworks CRM integration is not configured.');
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
