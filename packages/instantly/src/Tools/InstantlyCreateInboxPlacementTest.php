<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create an inbox placement test. Send test emails to check deliverability.
 */
class InstantlyCreateInboxPlacementTest implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_inbox_placement_test';
    }

    public function description(): string
    {
        return 'Create an inbox placement test. Send test emails to check deliverability.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Test name'],
            'type' => ['type' => 'integer', 'required' => true, 'description' => '0=one-time, 1=automated'],
            'sending_method' => ['type' => 'integer', 'required' => true, 'description' => '0=Instantly, 1=external'],
            'email_subject' => ['type' => 'string', 'required' => true, 'description' => 'Email subject'],
            'email_body' => ['type' => 'string', 'required' => true, 'description' => 'Email body'],
            'emails' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated seed emails'],
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

            $emails = $args['emails']; if (is_string($emails)) $emails = array_map('trim', explode(',', $emails)); $body = ['name' => $args['name'], 'type' => (int)$args['type'], 'sending_method' => (int)$args['sending_method'], 'email_subject' => $args['email_subject'], 'email_body' => $args['email_body'], 'emails' => $emails]; $result = $this->service->createInboxPlacementTest($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
