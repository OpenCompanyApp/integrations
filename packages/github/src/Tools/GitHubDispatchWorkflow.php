<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Trigger a GitHub Actions workflow dispatch event.
 */
class GitHubDispatchWorkflow implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_dispatch_workflow';
    }

    public function description(): string
    {
        return 'Trigger a GitHub Actions workflow dispatch event. The workflow must have a "workflow_dispatch" trigger in its YAML configuration. Requires the workflow ID or filename and a ref (branch or tag).';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'workflow_id' => ['type' => 'string', 'required' => true, 'description' => 'The workflow ID or filename (e.g. "ci.yml" or "12345").'],
            'ref' => ['type' => 'string', 'required' => true, 'description' => 'The git reference (branch or tag) to run the workflow on.'],
            'inputs' => ['type' => 'object', 'description' => 'Input parameters for the workflow. Keys must match the workflow_dispatch inputs defined in the workflow YAML.'],
        ];
    }

    /**
     * Dispatch a workflow run on a given branch or tag.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, workflow_id, ref, inputs)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $workflowId = $args['workflow_id'] ?? '';
        $ref = $args['ref'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if (empty($workflowId)) {
            return ToolResult::error('workflow_id is required.');
        }

        if (empty($ref)) {
            return ToolResult::error('ref (branch or tag) is required.');
        }

        try {
            $params = [
                'ref' => $ref,
            ];

            if (isset($args['inputs'])) {
                $params['inputs'] = $args['inputs'];
            }

            $result = $this->service->dispatchWorkflow($owner, $repo, $workflowId, $params);

            return ToolResult::success([
                'message' => 'Workflow dispatch triggered successfully.',
                'workflow_id' => $workflowId,
                'ref' => $ref,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
