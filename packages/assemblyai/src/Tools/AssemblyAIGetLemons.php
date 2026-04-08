<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve lemons (billing and usage information) from AssemblyAI.
 *
 * Sends a GET request to /lemons and returns the lemon resources.
 * Lemons represent the billing/credit system used by AssemblyAI.
 *
 * @see https://www.assemblyai.com/docs/assemblyai-api
 */
class AssemblyAIGetLemons implements Tool
{
    /**
     * @param  AssemblyAIService  $service  The AssemblyAI service instance.
     */
    public function __construct(
        private AssemblyAIService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'assemblyai_get_lemons';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Retrieve lemons (billing credits and usage information) from your AssemblyAI account.';
    }

    /**
     * This tool takes no parameters.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get lemons request.
     *
     * @param  array  $args  No parameters required.
     * @return ToolResult The lemons data or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            $result = $this->service->getLemons();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
