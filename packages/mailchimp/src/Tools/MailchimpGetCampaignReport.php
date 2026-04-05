<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Get a campaign report with send, open, click, and bounce stats.
 */
class MailchimpGetCampaignReport implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_get_campaign_report';
    }

    public function description(): string
    {
        return <<<'MD'
        Get a detailed report for a sent Mailchimp campaign.
        Returns send stats (emails sent, bounces), open rates, click rates, and industry benchmarks.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The campaign ID.',
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

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getCampaignReport($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
