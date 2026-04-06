<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PostmarkSendTemplate implements Tool
{
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_send_template';
    }

    public function description(): string
    {
        return 'Send an email using a Postmark template. Provide either a TemplateId or TemplateAlias along with the template model data.';
    }

    public function parameters(): array
    {
        return [
            'From' => ['type' => 'string', 'required' => true, 'description' => 'Sender email address (must be a verified sender signature). Example: "sender@example.com" or "Sender Name <sender@example.com>".'],
            'To' => ['type' => 'string', 'required' => true, 'description' => 'Recipient email address. Multiple recipients separated by commas.'],
            'TemplateId' => ['type' => 'integer', 'description' => 'The template ID to use. Use this or TemplateAlias.'],
            'TemplateAlias' => ['type' => 'string', 'description' => 'The template alias to use. Use this or TemplateId.'],
            'TemplateModel' => ['type' => 'array', 'description' => 'Key-value pairs to fill the template variables. Example: {"name": "John", "company": "Acme"}.'],
            'Cc' => ['type' => 'string', 'description' => 'CC recipients (comma-separated).'],
            'Bcc' => ['type' => 'string', 'description' => 'BCC recipients (comma-separated).'],
            'ReplyTo' => ['type' => 'string', 'description' => 'Reply-to email address.'],
            'Tag' => ['type' => 'string', 'description' => 'Tag for categorization and analytics.'],
            'TrackOpens' => ['type' => 'boolean', 'description' => 'Enable open tracking (default: server setting).'],
            'TrackLinks' => ['type' => 'string', 'description' => 'Link tracking mode: "None", "HtmlAndText", "HtmlOnly", "TextOnly".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            if (empty($args['TemplateId']) && empty($args['TemplateAlias'])) {
                return ToolResult::error('Either TemplateId or TemplateAlias is required.');
            }

            $params = [
                'From' => $args['From'],
                'To' => $args['To'],
                'TemplateModel' => $args['TemplateModel'] ?? [],
            ];

            if (isset($args['TemplateId'])) {
                $params['TemplateId'] = (int) $args['TemplateId'];
            }
            if (isset($args['TemplateAlias'])) {
                $params['TemplateAlias'] = $args['TemplateAlias'];
            }

            // Optional fields
            if (isset($args['Cc'])) {
                $params['Cc'] = $args['Cc'];
            }
            if (isset($args['Bcc'])) {
                $params['Bcc'] = $args['Bcc'];
            }
            if (isset($args['ReplyTo'])) {
                $params['ReplyTo'] = $args['ReplyTo'];
            }
            if (isset($args['Tag'])) {
                $params['Tag'] = $args['Tag'];
            }
            if (isset($args['TrackOpens'])) {
                $params['TrackOpens'] = (bool) $args['TrackOpens'];
            }
            if (isset($args['TrackLinks'])) {
                $params['TrackLinks'] = $args['TrackLinks'];
            }

            $result = $this->service->sendTemplateEmail($params);

            if (isset($result['ErrorCode']) && $result['ErrorCode'] !== 0) {
                return ToolResult::error("Postmark error ({$result['ErrorCode']}): " . ($result['Message'] ?? 'Unknown error'));
            }

            return ToolResult::success([
                'message' => 'Template email sent successfully.',
                'message_id' => $result['MessageID'] ?? null,
                'submitted_at' => $result['SubmittedAt'] ?? null,
                'to' => $result['To'] ?? $args['To'],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
