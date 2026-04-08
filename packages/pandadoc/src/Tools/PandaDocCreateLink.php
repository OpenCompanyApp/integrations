<?php

namespace OpenCompany\Integrations\PandaDoc\Tools;

use OpenCompany\Integrations\PandaDoc\PandaDocService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PandaDocCreateLink implements Tool
{
    public function __construct(
        private PandaDocService $service,
    ) {}

    public function name(): string
    {
        return 'pandadoc_create_link';
    }

    public function description(): string
    {
        return 'Create a signed sharing link (session) for a PandaDoc document. The link allows viewing the document without authentication.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The document UUID to create a sharing link for.'],
            'lifetime' => ['type' => 'integer', 'description' => 'Session lifetime in seconds (default: 3600). After this time the link expires.'],
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

            $lifetime = isset($args['lifetime']) ? (int) $args['lifetime'] : 3600;

            $result = $this->service->createLink($args['id'], $lifetime);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
