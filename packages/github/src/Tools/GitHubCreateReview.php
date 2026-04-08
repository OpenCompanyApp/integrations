<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a review on a GitHub pull request.
 */
class GitHubCreateReview implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_create_review';
    }

    public function description(): string
    {
        return 'Create a review on a GitHub pull request. Can approve, request changes, or comment. Optionally include inline review comments on specific lines.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'pull_number' => ['type' => 'integer', 'required' => true, 'description' => 'The pull request number.'],
            'body' => ['type' => 'string', 'description' => 'The body text of the review. Required when using COMMENT or REQUEST_CHANGES event.'],
            'event' => ['type' => 'string', 'description' => 'The review action: APPROVE, REQUEST_CHANGES, or COMMENT. Default: COMMENT.'],
            'comments' => ['type' => 'array', 'description' => 'Array of inline review comments. Each comment needs "path" (file path), "position" (line index in diff), and "body" (comment text).'],
        ];
    }

    /**
     * Submit an approve, request-changes, or comment review, optionally with inline comments.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, pull_number, body, event, comments)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $pullNumber = $args['pull_number'] ?? null;

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if ($pullNumber === null) {
            return ToolResult::error('pull_number is required.');
        }

        try {
            $params = [];

            $mapping = [
                'body' => 'body',
                'event' => 'event',
                'comments' => 'comments',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createReview($owner, $repo, (int) $pullNumber, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
