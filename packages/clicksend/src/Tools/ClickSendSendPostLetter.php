<?php

namespace OpenCompany\Integrations\ClickSend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ClickSend\ClickSendService;

/**
 * Send a post letter via ClickSend.
 *
 * Supports sending letters from a file URL or template ID,
 * with recipient details and duplex printing option.
 */
class ClickSendSendPostLetter implements Tool
{
    /**
     * @param  ClickSendService  $service  The ClickSend API client
     */
    public function __construct(
        private ClickSendService $service,
    ) {}

    public function name(): string
    {
        return 'clicksend_send_post_letter';
    }

    public function description(): string
    {
        return 'Send a post letter via ClickSend. Provide a file URL or template ID with recipient details.';
    }

    public function parameters(): array
    {
        return [
            'file_url' => [
                'type' => 'string',
                'description' => 'URL to the PDF file to send as a letter.',
            ],
            'template_id' => [
                'type' => 'integer',
                'description' => 'ClickSend template ID to use instead of a file URL.',
            ],
            'recipients' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of recipient objects with name, address, city, state, postal_code, country.',
            ],
            'duplex' => [
                'type' => 'integer',
                'description' => 'Print on both sides: 0 for simplex, 1 for duplex (default 0).',
            ],
        ];
    }

    /**
     * Send a post letter via ClickSend.
     *
     * @param  array<string, mixed>  $args  Tool arguments (file_url, template_id, recipients, duplex)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickSend integration is not configured.');
            }

            $recipients = $args['recipients'] ?? [];

            if (empty($recipients)) {
                return ToolResult::error('recipients is required and must be a non-empty array.');
            }

            if (empty($args['file_url']) && empty($args['template_id'])) {
                return ToolResult::error('Either file_url or template_id is required.');
            }

            $data = [
                'recipients' => $recipients,
            ];

            if (isset($args['file_url'])) {
                $data['file_url'] = $args['file_url'];
            }
            if (isset($args['template_id'])) {
                $data['template_id'] = (int) $args['template_id'];
            }
            if (isset($args['duplex'])) {
                $data['duplex'] = (int) $args['duplex'];
            }

            $result = $this->service->sendPostLetter($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
