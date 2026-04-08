<?php

namespace OpenCompany\Integrations\Mailjet\Tools;

use OpenCompany\Integrations\Mailjet\MailjetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailjetGetCampaign implements Tool
{
    public function __construct(
        private MailjetService $service,
    ) {}

    public function name(): string
    {
        return 'mailjet_get_campaign';
    }

    public function description(): string
    {
        return 'Get details for a single Mailjet email campaign by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The campaign ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailjet integration is not configured.');
            }

            $result = $this->service->getCampaign($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
