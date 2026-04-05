<?php

namespace OpenCompany\Integrations\Okta\Tools;

use OpenCompany\Integrations\Okta\OktaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OktaGetGroup implements Tool
{
    public function __construct(
        private OktaService $service,
    ) {}

    public function name(): string
    {
        return 'okta_get_group';
    }

    public function description(): string
    {
        return 'Get details for a specific Okta group by ID. Returns the group name, description, and type.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Okta group ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Okta integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Group ID is required.');
            }

            $group = $this->service->getGroup($id);

            return ToolResult::success($group);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
