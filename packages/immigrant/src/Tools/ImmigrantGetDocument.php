<?php

namespace OpenCompany\Integrations\Immigrant\Tools;

use OpenCompany\Integrations\Immigrant\ImmigrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: immigrant_get_document
 *
 * Retrieves a single document by its ID from Immigrant.
 */
class ImmigrantGetDocument implements Tool
{
    public function __construct(
        private ImmigrantService $service,
    ) {}

    public function name(): string
    {
        return 'immigrant_get_document';
    }

    public function description(): string
    {
        return 'Get details of a specific document by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Immigrant document ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Immigrant integration is not configured.');
            }

            $documentId = (string) $args['id'];
            $result = $this->service->getDocument($documentId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
