<?php

namespace OpenCompany\Integrations\Loom\Tools;

use OpenCompany\Integrations\Loom\LoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Loom folder.
 *
 * Retrieves full folder metadata including name, video count,
 * hierarchy information, and sharing settings.
 *
 * @see https://developer.loom.com/docs/api-reference
 */
class LoomGetFolder implements Tool
{
    public function __construct(
        private LoomService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'loom_get_folder';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Loom folder by its ID, including name, video count, and hierarchy.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'folder_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the Loom folder.'],
        ];
    }

    /**
     * Execute the get folder API call.
     *
     * @param  array{folder_id: string}  $args  Must contain the folder ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Loom integration is not configured.');
            }

            if (empty($args['folder_id'])) {
                return ToolResult::error('folder_id is required.');
            }

            $result = $this->service->getFolder($args['folder_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
