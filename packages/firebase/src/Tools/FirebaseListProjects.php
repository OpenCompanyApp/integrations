<?php

namespace OpenCompany\Integrations\Firebase\Tools;

use OpenCompany\Integrations\Firebase\FirebaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FirebaseListProjects implements Tool
{
    /**
     * @param FirebaseService $service The Firebase service instance.
     */
    public function __construct(
        private FirebaseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'firebase_list_projects';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List all Firebase projects the caller has access to. Returns project display names and IDs.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Maximum number of projects to return (default: 100, max: 256).'],
            'page_token' => ['type' => 'string', 'description' => 'Token for pagination from a previous list call.'],
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
                return ToolResult::error('Firebase integration is not configured.');
            }

            $params = [];
            if (isset($args['page_size'])) {
                $params['pageSize'] = (int) $args['page_size'];
            }
            if (isset($args['page_token'])) {
                $params['pageToken'] = $args['page_token'];
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
