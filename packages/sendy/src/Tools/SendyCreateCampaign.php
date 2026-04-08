<?php

namespace OpenCompany\Integrations\Sendy\Tools;

use OpenCompany\Integrations\Sendy\SendyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SendyCreateCampaign implements Tool
{
    public function __construct(
        private SendyService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'sendy_create_campaign';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new email campaign in Sendy. You can create a draft or send immediately. Requires a list ID, subject, HTML content, and sender details.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'from_name' => ['type' => 'string', 'required' => true, 'description' => 'Sender name (e.g., "Acme Corp").'],
            'from_email' => ['type' => 'string', 'required' => true, 'description' => 'Sender email address (e.g., "hello@acme.com").'],
            'reply_to' => ['type' => 'string', 'required' => true, 'description' => 'Reply-to email address.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Internal campaign title (for your reference).'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Email subject line.'],
            'html_text' => ['type' => 'string', 'required' => true, 'description' => 'HTML content of the email.'],
            'list_ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list IDs to send to.'],
            'plain_text' => ['type' => 'string', 'description' => 'Plain text version of the email. Auto-generated if omitted.'],
            'send_campaign' => ['type' => 'integer', 'description' => 'Set to 1 to send immediately, 0 or omit to save as draft.'],
            'brand_id' => ['type' => 'string', 'description' => 'Brand ID (required for multi-brand setups).'],
            'query_string' => ['type' => 'string', 'description' => 'UTM query string appended to links (e.g., "utm_source=sendy&utm_medium=email").'],
        ];
    }

    /**
     * Execute the create campaign tool.
     *
     * @param  array<string, mixed>  $args
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sendy integration is not configured.');
            }

            $params = [
                'from_name' => $args['from_name'],
                'from_email' => $args['from_email'],
                'reply_to' => $args['reply_to'],
                'title' => $args['title'],
                'subject' => $args['subject'],
                'html_text' => $args['html_text'],
                'list_ids' => $args['list_ids'],
            ];

            if (isset($args['plain_text'])) {
                $params['plain_text'] = $args['plain_text'];
            }

            if (isset($args['send_campaign'])) {
                $params['send_campaign'] = (int) $args['send_campaign'];
            }

            if (isset($args['brand_id'])) {
                $params['brand_id'] = $args['brand_id'];
            }

            if (isset($args['query_string'])) {
                $params['query_string'] = $args['query_string'];
            }

            $result = $this->service->createCampaign($params);

            if ($result['status'] === 'success') {
                return ToolResult::success([
                    'message' => $result['message'],
                    'campaign_id' => $result['campaign_id'] ?? null,
                ]);
            }

            return ToolResult::error($result['message']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
