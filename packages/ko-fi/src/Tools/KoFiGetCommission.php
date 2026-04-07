<?php

namespace OpenCompany\Integrations\KoFi\Tools;

use OpenCompany\Integrations\KoFi\KoFiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KoFiGetCommission implements Tool
{
    public function __construct(
        private KoFiService $service,
    ) {}

    public function name(): string
    {
        return 'ko-fi_get_commission';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Ko-fi commission by its ID. Returns full commission data including description, status, and requester details.';
    }

    public function parameters(): array
    {
        return [
            'commission_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the commission to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ko-fi integration is not configured.');
            }

            if (empty($args['commission_id'])) {
                return ToolResult::error('commission_id is required.');
            }

            $result = $this->service->getCommission($args['commission_id']);

            $commission = $result['commission'] ?? $result;

            return ToolResult::success($commission);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
