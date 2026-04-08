<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Update a Mailchimp campaign's settings.
 */
class MailchimpUpdateCampaign implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_update_campaign';
    }

    public function description(): string
    {
        return <<<'MD'
        Update a Mailchimp campaign's settings such as subject line, title, from name, or reply-to.
        Provide the campaign ID and a settings object with the fields to update.
        Returns the updated campaign details.
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
            'settings' => [
                'type' => 'object',
                'required' => true,
                'description' => 'Campaign settings to update (e.g. subject_line, title, from_name, reply_to).',
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

            $settings = $args['settings'] ?? [];
            if (empty($settings)) {
                return ToolResult::error('The "settings" parameter is required.');
            }

            $result = $this->service->updateCampaign($id, $settings);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
