<?php

namespace OpenCompany\Integrations\Loops\Tools;

use OpenCompany\Integrations\Loops\LoopsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LoopsGetContact implements Tool
{
    public function __construct(
        private LoopsService $service,
    ) {}

    public function name(): string
    {
        return 'loops_get_contact';
    }

    public function description(): string
    {
        return 'Get a single contact from Loops by their unique contact ID. Returns full contact details including email, name, and custom properties.';
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique contact ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Loops integration is not configured.');
            }

            if (empty($args['contact_id'])) {
                return ToolResult::error('contact_id is required.');
            }

            $result = $this->service->getContact($args['contact_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
