<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Opportunity
 *
 * Retrieves a single opportunity from Insightly CRM by its ID.
 *
 * @see https://api.na1.insightly.com/v3.1/Help#!/Opportunities/GetEntity
 */
class InsightlyGetOpportunity implements Tool
{
    /**
     * Create a new InsightlyGetOpportunity tool instance.
     *
     * @param  InsightlyService  $service  The Insightly API service.
     */
    public function __construct(
        private InsightlyService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'insightly_get_opportunity';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Get detailed information about a single Insightly opportunity by ID. Returns all opportunity fields including amount, stage, pipeline, and linked contacts.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Insightly opportunity ID.'],
        ];
    }

    /**
     * Execute the get opportunity tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing 'id'.
     * @return ToolResult The opportunity record or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Insightly integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getOpportunity((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
