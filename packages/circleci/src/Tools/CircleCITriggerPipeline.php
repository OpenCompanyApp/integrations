<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

use OpenCompany\Integrations\CircleCI\CircleCIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Trigger a new pipeline on a CircleCI project.
 *
 * Starts a new pipeline run for the specified project and branch.
 * Optional pipeline parameters can be passed to parameterized configs.
 */
class CircleCITriggerPipeline implements Tool
{
    public function __construct(
        private CircleCIService $service,
    ) {}

    public function name(): string
    {
        return 'circleci_trigger_pipeline';
    }

    public function description(): string
    {
        return 'Trigger a new CI/CD pipeline on a CircleCI project. Specify the organization, project, branch, and optional pipeline parameters.';
    }

    public function parameters(): array
    {
        return [
            'orgSlug' => ['type' => 'string', 'required' => true, 'description' => 'Organization slug (e.g., "gh/my-org" for GitHub, "bb/my-org" for Bitbucket).'],
            'projectSlug' => ['type' => 'string', 'required' => true, 'description' => 'Project slug / repository name (e.g., "my-repo").'],
            'branch' => ['type' => 'string', 'description' => 'The branch to run the pipeline on (e.g., "main"). Defaults to the project\'s default branch.'],
            'parameters' => ['type' => 'object', 'description' => 'Pipeline parameters to pass (for parameterized configs). Pass as a JSON object with string/boolean/number values.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CircleCI integration is not configured.');
            }

            $body = [];

            if (isset($args['branch'])) {
                $body['branch'] = $args['branch'];
            }

            if (isset($args['parameters'])) {
                $params = $args['parameters'];
                $body['parameters'] = is_string($params) ? json_decode($params, true) : $params;
            }

            $result = $this->service->triggerPipeline(
                $args['orgSlug'],
                $args['projectSlug'],
                $body,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
