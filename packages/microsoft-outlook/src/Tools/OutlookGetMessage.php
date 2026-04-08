<?php

namespace OpenCompany\Integrations\MicrosoftOutlook\Tools;

use OpenCompany\Integrations\MicrosoftOutlook\OutlookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: outlook_get_message
 *
 * Retrieves a single email message by its id from the Microsoft Graph API.
 */
class OutlookGetMessage implements Tool
{
    /**
     * @param  OutlookService  $service  The Outlook API service instance.
     */
    public function __construct(
        private OutlookService $service,
    ) {}

    /**
     * Machine-name of the tool.
     */
    public function name(): string
    {
        return 'outlook_get_message';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Retrieve a single email message by its id. Returns the full message including body, sender, recipients, subject, and attachments metadata.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'message_id' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'The unique id of the message to retrieve.',
            ],
            'select' => [
                'type'        => 'string',
                'description' => 'Comma-separated list of properties to include, e.g. "subject,body,from,toRecipients".',
            ],
        ];
    }

    /**
     * Execute the tool: get a single message by id.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft Outlook integration is not configured.');
            }

            $params = [];
            if (isset($args['select'])) {
                $params['$select'] = $args['select'];
            }

            $message = $this->service->getMessage($args['message_id'], $params);

            return ToolResult::success($message);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
