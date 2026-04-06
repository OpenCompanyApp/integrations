<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

use OpenCompany\Integrations\Appwrite\AppwriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AppwriteGetDatabase implements Tool
{
    /**
     * @param AppwriteService $service The Appwrite service instance.
     */
    public function __construct(
        private AppwriteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'appwrite_get_database';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Get details of a specific Appwrite database by its ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The database ID.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array $args The tool arguments.
     * @return ToolResult The result of the tool execution.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Appwrite integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Database ID is required.');
            }

            $result = $this->service->getDatabase($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
