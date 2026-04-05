<?php

namespace OpenCompany\Integrations\PandaDoc\Tools;

use OpenCompany\Integrations\PandaDoc\PandaDocService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PandaDocCreateDocument implements Tool
{
    public function __construct(
        private PandaDocService $service,
    ) {}

    public function name(): string
    {
        return 'pandadoc_create_document';
    }

    public function description(): string
    {
        return 'Create a new PandaDoc document from an existing template. The document is created in draft status and can then be sent for signature.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name for the new document.'],
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'UUID of the template to create the document from.'],
            'recipients' => ['type' => 'array', 'description' => 'List of recipients. Each recipient should have "email" and optionally "first_name", "last_name", "role".'],
            'tokens' => ['type' => 'array', 'description' => 'List of template tokens to fill. Each token should have "name" and "value".'],
            'fields' => ['type' => 'array', 'description' => 'Prefill fields. Each field should have "name" (or "field_uuid") and "value".'],
            'metadata' => ['type' => 'object', 'description' => 'Custom metadata key-value pairs to attach to the document.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PandaDoc integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Document name is required.');
            }

            if (empty($args['template_id'])) {
                return ToolResult::error('Template ID is required.');
            }

            $options = [];

            if (isset($args['recipients'])) {
                $options['recipients'] = $args['recipients'];
            }

            if (isset($args['tokens'])) {
                $options['tokens'] = $args['tokens'];
            }

            if (isset($args['fields'])) {
                $options['fields'] = $args['fields'];
            }

            if (isset($args['metadata'])) {
                $options['metadata'] = $args['metadata'];
            }

            $result = $this->service->createDocument($args['name'], $args['template_id'], $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
