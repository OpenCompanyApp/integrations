<?php

namespace OpenCompany\Integrations\GetResponse\Tools;

use OpenCompany\Integrations\GetResponse\GetResponseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GetResponseGetCampaign implements Tool
{
    public function __construct(
        private GetResponseService $service,
    ) {}

    public function name(): string
    {
        return 'getresponse_get_campaign';
    }

    public function description(): string
    {
        return 'Get details of a specific campaign in GetResponse by its unique identifier.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique campaign identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GetResponse integration is not configured.');
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
