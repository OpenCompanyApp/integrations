<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to verify Beehiiv authentication and list accessible publications.
 *
 * Primarily used for connection testing and verifying that the API key is valid.
 */
class BeehiivGetCurrentUser implements Tool
{
    /**
     * Create a new BeehiivGetCurrentUser tool instance.
     */
    public function __construct(
        private BeehiivService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'beehiiv_get_current_user';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Verify your Beehiiv API key and list all publications you have access to. Use this to confirm the integration is working and to find your publication ID.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — list publications from Beehiiv.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $result = $this->service->listPublications();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
