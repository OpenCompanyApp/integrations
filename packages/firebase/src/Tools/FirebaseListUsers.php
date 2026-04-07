<?php

namespace OpenCompany\Integrations\Firebase\Tools;

use OpenCompany\Integrations\Firebase\FirebaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FirebaseListUsers implements Tool
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
        return 'firebase_list_users';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List users in a Firebase project via the Identity Toolkit API.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'max_results' => ['type' => 'integer', 'description' => 'Maximum number of users to return (default: 1000, max: 1000).'],
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
            if (isset($args['max_results'])) {
                $params['maxResults'] = (int) $args['max_results'];
            }
            if (isset($args['page_token'])) {
                $params['nextPageToken'] = $args['page_token'];
            }

            $result = $this->service->listUsers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
