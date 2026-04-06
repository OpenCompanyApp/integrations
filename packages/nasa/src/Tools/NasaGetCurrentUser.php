<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\Integrations\Nasa\NasaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NasaGetCurrentUser implements Tool
{
    /**
     * Create a new NasaGetCurrentUser tool instance.
     *
     * @param  NasaService  $service  The NASA service for making API calls.
     */
    public function __construct(
        private NasaService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'nasa_get_current_user';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get information about the current NASA API configuration. The NASA API is public and does not require user authentication — this tool returns the API key status and available endpoints.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, mixed> Empty — this tool takes no parameters.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user tool.
     *
     * Returns a static response since the NASA API is public and does not
     * require user-level authentication.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     * @return ToolResult The API configuration info.
     */
    public function execute(array $args): ToolResult
    {
        return ToolResult::success([
            'service' => 'NASA Open APIs',
            'message' => 'NASA API does not require auth for user — it uses a public API key for rate limiting.',
            'auth_type' => 'api_key',
            'configured' => $this->service->isConfigured(),
            'note' => 'Using the DEMO_KEY has rate limits of 30 requests per hour and 50 requests per day. Register for a free API key at api.nasa.gov for higher limits.',
        ]);
    }
}
