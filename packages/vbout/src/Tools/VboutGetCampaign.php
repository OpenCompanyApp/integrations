<?php

namespace OpenCompany\Integrations\Vbout\Tools;

use OpenCompany\Integrations\Vbout\VboutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VboutGetCampaign implements Tool
{
    public function __construct(
        private VboutService $service,
    ) {}

    public function name(): string
    {
        return 'vbout_get_campaign';
    }

    public function description(): string
    {
        return 'Get details for a specific VBout email campaign by ID, including subject, content, status, and delivery statistics.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The VBout campaign ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('VBout integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Campaign ID is required.');
            }

            $result = $this->service->getCampaign($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
