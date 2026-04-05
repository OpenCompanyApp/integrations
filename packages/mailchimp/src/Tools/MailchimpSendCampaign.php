<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Send a Mailchimp campaign immediately.
 */
class MailchimpSendCampaign implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_send_campaign';
    }

    public function description(): string
    {
        return <<<'MD'
        Send a Mailchimp campaign immediately.
        The campaign must already have content configured and be in a "save" or "paused" state.
        This action is irreversible — once sent, the campaign cannot be recalled.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The campaign ID to send.',
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

            $this->service->sendCampaign($id);

            return ToolResult::success([
                'message' => "Campaign {$id} has been sent.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
