<?php

namespace OpenCompany\Integrations\Grist\Tools;

use OpenCompany\Integrations\Grist\GristService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Grist document by ID.
 */
class GristGetDoc implements Tool
{
    /**
     * @param  GristService  $service  The Grist API client
     */
    public function __construct(
        private GristService $service,
    ) {}

    public function name(): string
    {
        return 'grist_get_doc';
    }

    public function description(): string
    {
        return 'Get details for a single Grist document by ID.';
    }

    public function parameters(): array
    {
        return [
            'doc_id' => ['type' => 'string', 'required' => true, 'description' => 'Grist document ID.'],
        ];
    }

    /**
     * Get a document by ID.
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

            $result = $this->service->getDoc($docId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
