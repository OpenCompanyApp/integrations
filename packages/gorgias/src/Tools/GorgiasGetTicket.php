<?php

namespace OpenCompany\Integrations\Gorgias\Tools;

use OpenCompany\Integrations\Gorgias\GorgiasService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GorgiasGetTicket implements Tool
{
    public function __construct(
        private GorgiasService $service,
    ) {}

    public function name(): string
    {
        return 'gorgias_get_ticket';
    }

    public function description(): string
    {
        return 'Get details of a specific Gorgias ticket by ID, including subject, body, status, assignee, and customer information.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The ticket ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gorgias integration is not configured.');
            }

            $result = $this->service->getTicket($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
