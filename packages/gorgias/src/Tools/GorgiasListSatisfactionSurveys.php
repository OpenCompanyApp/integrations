<?php

namespace OpenCompany\Integrations\Gorgias\Tools;

use OpenCompany\Integrations\Gorgias\GorgiasService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GorgiasListSatisfactionSurveys implements Tool
{
    public function __construct(
        private GorgiasService $service,
    ) {}

    public function name(): string
    {
        return 'gorgias_list_satisfaction_surveys';
    }

    public function description(): string
    {
        return 'List satisfaction survey responses in Gorgias. Optionally filter by ticket ID. Returns paginated results with ratings and feedback.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of surveys per page (max 100).'],
            'ticket_id' => ['type' => 'string', 'description' => 'Filter surveys by ticket ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gorgias integration is not configured.');
            }

            $result = $this->service->listSatisfactionSurveys(
                page: isset($args['page']) ? (int) $args['page'] : null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                ticketId: $args['ticket_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
