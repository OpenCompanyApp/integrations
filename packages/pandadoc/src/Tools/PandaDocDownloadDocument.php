<?php

namespace OpenCompany\Integrations\PandaDoc\Tools;

use OpenCompany\Integrations\PandaDoc\PandaDocService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PandaDocDownloadDocument implements Tool
{
    public function __construct(
        private PandaDocService $service,
    ) {}

    public function name(): string
    {
        return 'pandadoc_download_document';
    }

    public function description(): string
    {
        return 'Download a PandaDoc document as a PDF. Returns the PDF content as a base64-encoded string.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The document UUID to download.'],
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

            $result = $this->service->downloadDocument($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
