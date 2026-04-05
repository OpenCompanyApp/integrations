<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DevinCreateSession implements Tool
{
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_create_session';
    }

    public function description(): string
    {
        return 'Create a new Devin AI session. Provide a task prompt describing what you want Devin to do. Optionally provide an idempotency key to prevent duplicate sessions.';
    }

    public function parameters(): array
    {
        return [
            'prompt' => ['type' => 'string', 'required' => true, 'description' => 'The task description for Devin to execute. Be specific about what you want accomplished.'],
            'idempotency_key' => ['type' => 'string', 'description' => 'An optional unique key to prevent duplicate session creation. If a session with this key already exists, the existing session is returned.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $prompt = $args['prompt'];
            $idempotencyKey = $args['idempotency_key'] ?? null;

            $result = $this->service->createSession($prompt, $idempotencyKey);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
