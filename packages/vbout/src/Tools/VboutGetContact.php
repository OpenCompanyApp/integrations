<?php

namespace OpenCompany\Integrations\Vbout\Tools;

use OpenCompany\Integrations\Vbout\VboutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VboutGetContact implements Tool
{
    public function __construct(
        private VboutService $service,
    ) {}

    public function name(): string
    {
        return 'vbout_get_contact';
    }

    public function description(): string
    {
        return 'Get details for a specific VBout contact by ID, including email, name, custom fields, and list memberships.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The VBout contact ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('VBout integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->getContact($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
