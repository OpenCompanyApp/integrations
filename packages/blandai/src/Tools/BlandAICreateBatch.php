<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * Create a Bland AI batch or campaign.
 *
 * Sends many calls at once using the v2 batches endpoint.
 */
class BlandAICreateBatch implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_create_batch';
    }

    public function description(): string
    {
        return 'Create a Bland AI batch or campaign with phone numbers, shared call params, and optional sequence.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Batch/campaign name.'],
            'phone_numbers' => ['type' => 'array', 'required' => true, 'description' => 'Array of phone number objects.'],
            'call_params' => ['type' => 'object', 'description' => 'Shared Send Call parameters applied to each call.'],
            'sequence' => ['type' => 'object', 'description' => 'Optional campaign retry sequence.'],
        ];
    }

    /**
     * Create a batch or campaign.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            return ToolResult::success($this->service->createBatch(array_intersect_key($args, array_flip(['name', 'phone_numbers', 'call_params', 'sequence']))));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
