<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BoxGetCurrentUser implements Tool
{
    /**
     * Create a new BoxGetCurrentUser tool instance.
     */
    public function __construct(
        private BoxService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'box_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get information about the currently authenticated Box user. Returns user name, email, login, and account details.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Box integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'name' => $result['name'] ?? null,
                'login' => $result['login'] ?? null,
                'email' => $result['login'] ?? null,
                'type' => $result['type'] ?? 'user',
                'created_at' => $result['created_at'] ?? null,
                'modified_at' => $result['modified_at'] ?? null,
                'enterprise' => $result['enterprise'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
