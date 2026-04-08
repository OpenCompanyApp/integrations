<?php

namespace OpenCompany\Integrations\Grist\Tools;

use OpenCompany\Integrations\Grist\GristService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all documents in a Grist organization.
 */
class GristListDocs implements Tool
{
    /**
     * @param  GristService  $service  The Grist API client
     */
    public function __construct(
        private GristService $service,
    ) {}

    public function name(): string
    {
        return 'grist_list_docs';
    }

    public function description(): string
    {
        return 'List all documents in a Grist organization.';
    }

    public function parameters(): array
    {
        return [
            'org_id' => ['type' => 'integer', 'required' => true, 'description' => 'Grist organization ID.'],
        ];
    }

    /**
     * List all documents in an organization.
     *
     * @param  array<string, mixed>  $args  Tool arguments (org_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Grist integration is not configured.');
            }

            $orgId = $args['org_id'] ?? '';

            if (empty($orgId)) {
                return ToolResult::error('org_id is required.');
            }

            $result = $this->service->listDocs((int) $orgId);

            return ToolResult::success([
                'docs' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
