<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\Integrations\Salesloft\SalesloftService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SalesloftCreateSequence implements Tool
{
    public function __construct(
        private SalesloftService $service,
    ) {}

    public function name(): string
    {
        return 'salesloft_create_sequence';
    }

    public function description(): string
    {
        return 'Create a new call sequence in Salesloft with steps, owner assignment, status, and targets.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the call sequence.'],
            'steps' => ['type' => 'array', 'description' => 'Array of step definitions for the sequence. Each step defines an action (e.g., call, email).'],
            'owner_id' => ['type' => 'integer', 'description' => 'ID of the user who will own this sequence.'],
            'status' => ['type' => 'string', 'description' => 'Initial status of the sequence (e.g., "active", "paused").'],
            'targets' => ['type' => 'array', 'description' => 'Array of target people or account IDs to add to the sequence.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Salesloft integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Sequence name is required.');
            }

            $data = array_filter([
                'name' => $args['name'],
                'steps' => $args['steps'] ?? null,
                'owner_id' => $args['owner_id'] ?? null,
                'status' => $args['status'] ?? null,
                'targets' => $args['targets'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->createSequence($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
