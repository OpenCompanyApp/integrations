<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing available voices from the HeyGen API.
 *
 * Returns all voices accessible to the authenticated user, including
 * their IDs, names, language codes, gender, and preview audio URLs.
 */
class HeyGenListVoices implements Tool
{
    /**
     * Create a new HeyGenListVoices tool instance.
     *
     * @param  HeyGenService  $service  The HeyGen API service.
     */
    public function __construct(
        private HeyGenService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'heygen_list_voices';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List all available voices in HeyGen. Returns voice IDs, names, languages, gender, and preview audio URLs for use in video generation.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list voices tool.
     *
     * @param  array  $args  The tool arguments (none required).
     * @return ToolResult The result containing the list of voices or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            $result = $this->service->listVoices();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
