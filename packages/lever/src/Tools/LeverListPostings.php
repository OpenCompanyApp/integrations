<?php

namespace OpenCompany\Integrations\Lever\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Lever\LeverService;

/**
 * List published job postings for a Lever site.
 *
 * Supports pagination and Lever's exact posting filters, including repeated
 * location, commitment, team, and department values.
 */
class LeverListPostings implements Tool
{
    /**
     * @param  LeverService  $service  Lever Postings API client.
     */
    public function __construct(private LeverService $service) {}

    public function name(): string
    {
        return 'lever_list_postings';
    }

    public function description(): string
    {
        return 'List published Lever job postings for a site.

Official Lever endpoint: GET /v0/postings/{site}
Supports pagination, output mode, grouping, and filters for location, commitment, team, department, and level.';
    }

    public function parameters(): array
    {
        return [
            'site' => ['type' => 'string', 'required' => true, 'description' => 'Lever site slug, usually the company name from jobs.lever.co/{site}.'],
            'mode' => ['type' => 'string', 'required' => false, 'description' => 'Output mode. Use json for structured agent results.', 'enum' => ['json', 'html', 'iframe']],
            'skip' => ['type' => 'integer', 'required' => false, 'description' => 'Number of postings to skip.'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of postings to return.'],
            'location' => ['type' => 'array', 'required' => false, 'description' => 'Filter by one or more locations. Multiple values are ORed by Lever.', 'items' => ['type' => 'string']],
            'commitment' => ['type' => 'array', 'required' => false, 'description' => 'Filter by one or more commitment values.', 'items' => ['type' => 'string']],
            'team' => ['type' => 'array', 'required' => false, 'description' => 'Filter by one or more teams.', 'items' => ['type' => 'string']],
            'department' => ['type' => 'array', 'required' => false, 'description' => 'Filter by one or more departments.', 'items' => ['type' => 'string']],
            'level' => ['type' => 'string', 'required' => false, 'description' => 'Filter by level.'],
            'group' => ['type' => 'string', 'required' => false, 'description' => 'Group results by a Lever category.', 'enum' => ['location', 'commitment', 'team']],
            'css' => ['type' => 'string', 'required' => false, 'description' => 'Iframe mode CSS URL allowed in Lever job site settings.'],
            'resize' => ['type' => 'string', 'required' => false, 'description' => 'Iframe mode resize helper URL allowed in Lever job site settings.'],
            'query' => ['type' => 'object', 'required' => false, 'description' => 'Optional query object. Top-level keys take precedence when both are present.'],
        ];
    }

    /**
     * Execute the Lever postings list request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $site = $this->requireString($args, 'site');
            $query = isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
            foreach (['mode', 'skip', 'limit', 'location', 'commitment', 'team', 'department', 'level', 'group', 'css', 'resize'] as $key) {
                if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                    $query[$key] = $args[$key];
                }
            }

            $query['mode'] ??= 'json';

            return ToolResult::success($this->service->listPostings($site, $query));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Require a non-empty string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireString(array $args, string $key): string
    {
        $value = $args[$key] ?? null;
        if (!is_string($value) || trim($value) === '') {
            throw new InvalidArgumentException($key.' must be a non-empty string.');
        }

        return $value;
    }
}
