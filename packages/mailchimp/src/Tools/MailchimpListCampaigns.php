<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * List Mailchimp campaigns with optional filters.
 */
class MailchimpListCampaigns implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_list_campaigns';
    }

    public function description(): string
    {
        return <<<'MD'
        List campaigns in the Mailchimp account with offset-based pagination and optional filters.
        Filter by status (save, paused, schedule, sending, sent) or type (regular, plaintext, absplit, rss, variate).
        Returns each campaign's ID, title, status, and send time.
        MD;
    }

    public function parameters(): array
    {
        return [
            'count' => [
                'type' => 'integer',
                'description' => 'Number of campaigns to return.',
                'default' => 100,
            ],
            'offset' => [
                'type' => 'integer',
                'description' => 'Number of campaigns to skip for pagination.',
                'default' => 0,
            ],
            'status' => [
                'type' => 'string',
                'description' => 'Filter by campaign status.',
                'enum' => ['save', 'paused', 'schedule', 'sending', 'sent'],
            ],
            'type' => [
                'type' => 'string',
                'description' => 'Filter by campaign type.',
                'enum' => ['regular', 'plaintext', 'absplit', 'rss', 'variate'],
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailchimp integration is not configured.');
            }

            $result = $this->service->listCampaigns(
                count: (int) ($args['count'] ?? 100),
                offset: (int) ($args['offset'] ?? 0),
                status: $args['status'] ?? null,
                type: $args['type'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
