<?php

namespace OpenCompany\Integrations\PandaDoc\Tools;

use OpenCompany\Integrations\PandaDoc\PandaDocService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PandaDocSendDocument implements Tool
{
    public function __construct(
        private PandaDocService $service,
    ) {}

    public function name(): string
    {
        return 'pandadoc_send_document';
    }

    public function description(): string
    {
        return 'Send a PandaDoc document to recipients for signature. The document must be in draft status. Once sent, recipients will receive an email notification.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The document UUID to send.'],
            'message' => ['type' => 'string', 'description' => 'Custom message to include in the email notification to recipients.'],
            'silent' => ['type' => 'boolean', 'description' => 'If true, the document changes status to sent but no email is sent to recipients (default: false).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PandaDoc integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Document ID is required.');
            }

            $options = [];

            if (isset($args['message'])) {
                $options['message'] = $args['message'];
            }

            if (isset($args['silent'])) {
                $options['silent'] = (bool) $args['silent'];
            }

            $result = $this->service->sendDocument($args['id'], $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
