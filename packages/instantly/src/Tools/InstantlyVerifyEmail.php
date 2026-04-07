<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Verify an email address. Returns deliverability status.
 */
class InstantlyVerifyEmail implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_verify_email';
    }

    public function description(): string
    {
        return 'Verify an email address. Returns deliverability status.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email to verify'],
            'webhook_url' => ['type' => 'string', 'required' => false, 'description' => 'Webhook URL for results'],
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

            $result = $body = ['email' => $args['email']]; if (isset($args['webhook_url'])) $body['webhook_url'] = $args['webhook_url']; $this->service->verifyEmail($args['email'], $args['webhook_url'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
