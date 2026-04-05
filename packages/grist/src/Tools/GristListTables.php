<?php

namespace OpenCompany\Integrations\Grist\Tools;

use OpenCompany\Integrations\Grist\GristService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all tables in a Grist document.
 */
class GristListTables implements Tool
{
    /**
     * @param  GristService  $service  The Grist API client
     */
    public function __construct(
        private GristService $service,
    ) {}

    public function name(): string
    {
        return 'grist_list_tables';
    }

    public function description(): string
    {
        return 'List all tables in a Grist document.';
    }

    public function parameters(): array
    {
        return [
            'doc_id' => ['type' => 'string', 'required' => true, 'description' => 'Grist document ID.'],
        ];
    }

    /**
     * List all tables in a document.
     *
     * @param  array<string, mixed>  $args  Tool arguments (doc_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Grist integration is not configured.');
            }

            $docId = $args['doc_id'] ?? '';

            if (empty($docId)) {
                return ToolResult::error('doc_id is required.');
            }

            $result = $this->service->listTables($docId);

            return ToolResult::success([
                'tables' => $result['tables'] ?? $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
