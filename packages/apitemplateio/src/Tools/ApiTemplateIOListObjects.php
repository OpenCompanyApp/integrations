<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;

/**
 * List generated APITemplate.io objects.
 *
 * Returns generated PDFs and images with optional transaction and template filters.
 */
class ApiTemplateIOListObjects implements Tool
{
    /**
     * @param  ApiTemplateIOService  $service  The APITemplate.io API client
     */
    public function __construct(
        private ApiTemplateIOService $service,
    ) {}

    public function name(): string
    {
        return 'apitemplateio_list_objects';
    }

    public function description(): string
    {
        return 'List generated PDFs and images, optionally filtered by template ID, transaction type, or transaction reference.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of records to return. Defaults to 300 upstream.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of records to skip. Defaults to 0 upstream.'],
            'template_id' => ['type' => 'string', 'description' => 'Filter generated objects by template ID.'],
            'transaction_type' => ['type' => 'string', 'description' => 'Filter by transaction type: PDF, JPEG, or MERGE.', 'enum' => ['PDF', 'JPEG', 'MERGE']],
            'transaction_ref' => ['type' => 'string', 'description' => 'Filter by a specific generated object transaction reference.'],
        ];
    }

    /**
     * List generated objects.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('API Template IO integration is not configured.');
            }

            return ToolResult::success($this->service->listObjects($this->queryParams($args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>
     */
    private function queryParams(array $args): array
    {
        $params = [];
        foreach (['limit', 'offset', 'template_id', 'transaction_type', 'transaction_ref'] as $key) {
            if (isset($args[$key])) {
                $params[$key] = $args[$key];
            }
        }

        return $params;
    }
}
