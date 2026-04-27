<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Reply to an email thread.
 */
class InstantlyReplyToEmail implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_reply_to_email';
    }

    public function description(): string
    {
        return 'Reply to an email thread.';
    }

    public function parameters(): array
    {
        return [
            'lead_id' => ['type' => 'string', 'required' => true, 'description' => 'Lead ID'],
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID'],
            'account_email' => ['type' => 'string', 'required' => false, 'description' => 'Sender email'],
            'reply_body' => ['type' => 'string', 'required' => true, 'description' => 'Reply content'],
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

            $body = array_intersect_key($args, array_flip(['lead_id','campaign_id','account_email','reply_body'])); $result = $this->service->replyToEmail($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
