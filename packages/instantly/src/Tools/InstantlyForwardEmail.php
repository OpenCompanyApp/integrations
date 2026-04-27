<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Forward an email.
 */
class InstantlyForwardEmail implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_forward_email';
    }

    public function description(): string
    {
        return 'Forward an email.';
    }

    public function parameters(): array
    {
        return [
            'lead_id' => ['type' => 'string', 'required' => true, 'description' => 'Lead ID'],
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID'],
            'forward_to' => ['type' => 'string', 'required' => true, 'description' => 'Recipient email'],
            'forward_body' => ['type' => 'string', 'required' => false, 'description' => 'Forward note'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = array_intersect_key($args, array_flip(['lead_id','campaign_id','forward_to','forward_body'])); $result = $this->service->forwardEmail($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
