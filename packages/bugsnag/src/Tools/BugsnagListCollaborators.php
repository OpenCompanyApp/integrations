<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

use OpenCompany\Integrations\Bugsnag\BugsnagService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BugsnagListCollaborators implements Tool
{
    public function __construct(
        private BugsnagService $service,
    ) {}

    public function name(): string
    {
        return 'bugsnag_list_collaborators';
    }

    public function description(): string
    {
        return 'List collaborators (team members) for a Bugsnag organization.';
    }

    public function parameters(): array
    {
        return [
            'org_id' => ['type' => 'string', 'required' => true, 'description' => 'The organization ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of collaborators to return (default: 30).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of collaborators to skip for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bugsnag integration is not configured.');
            }

            $orgId = $args['org_id'] ?? '';

            if (empty($orgId)) {
                return ToolResult::error('Organization ID is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 30;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listCollaborators($orgId, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
