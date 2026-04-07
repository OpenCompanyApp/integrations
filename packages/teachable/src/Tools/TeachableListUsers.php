<?php

namespace OpenCompany\Integrations\Teachable\Tools;

use OpenCompany\Integrations\Teachable\TeachableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list users from a Teachable school.
 *
 * Supports pagination via page/per_page parameters.
 */
class TeachableListUsers implements Tool
{
    /**
     * Create a new TeachableListUsers tool instance.
     */
    public function __construct(
        private TeachableService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'teachable_list_users';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List users from your Teachable school. Paginate with page/per_page parameters.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of users per page (default: 25, max: 100).'],
        ];
    }

    /**
     * Execute the tool — list users from Teachable.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teachable integration is not configured. Provide an API key.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listUsers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
