<?php

namespace OpenCompany\Integrations\Hunter\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Hunter\HunterService;

/**
 * Retrieve a single lead by ID from Hunter.io.
 */
class HunterGetLead implements Tool
{
    /** @param HunterService $service The Hunter.io API client */
    public function __construct(
        private HunterService $service,
    ) {}

    public function name(): string
    {
        return 'hunter_get_lead';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve detailed information about a single lead by its ID. Returns the lead's
        email address, name, company, and any associated lists or custom fields.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'The lead ID.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Hunter integration is not configured.');
            }

            $id = $args['id'] ?? null;
            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getLead((int) $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
