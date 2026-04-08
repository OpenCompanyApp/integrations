<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

use OpenCompany\Integrations\CircleCI\CircleCIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List projects in a CircleCI organization.
 *
 * Returns all projects that are set up in CircleCI for the given
 * organization, including repository information and VCS details.
 */
class CircleCIListProjects implements Tool
{
    public function __construct(
        private CircleCIService $service,
    ) {}

    public function name(): string
    {
        return 'circleci_list_projects';
    }

    public function description(): string
    {
        return 'List all projects in a CircleCI organization. Returns project slugs, repository URLs, and VCS provider information.';
    }

    public function parameters(): array
    {
        return [
            'orgSlug' => ['type' => 'string', 'required' => true, 'description' => 'Organization slug (e.g., "gh/my-org" for GitHub, "bb/my-org" for Bitbucket).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of projects to return.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CircleCI integration is not configured.');
            }

            $params = [
                'org-slug' => $args['orgSlug'],
            ];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
