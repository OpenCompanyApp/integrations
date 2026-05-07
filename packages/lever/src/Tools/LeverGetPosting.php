<?php

namespace OpenCompany\Integrations\Lever\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Lever\LeverService;

/**
 * Fetch one published Lever job posting by posting ID.
 *
 * Returns the same JSON field shape documented for Lever's posting list API.
 */
class LeverGetPosting implements Tool
{
    /**
     * @param  LeverService  $service  Lever Postings API client.
     */
    public function __construct(private LeverService $service) {}

    public function name(): string
    {
        return 'lever_get_posting';
    }

    public function description(): string
    {
        return 'Get a single published Lever job posting by ID.

Official Lever endpoint: GET /v0/postings/{site}/{posting_id}
Returns JSON only.';
    }

    public function parameters(): array
    {
        return [
            'site' => ['type' => 'string', 'required' => true, 'description' => 'Lever site slug, usually the company name from jobs.lever.co/{site}.'],
            'posting_id' => ['type' => 'string', 'required' => true, 'description' => 'Lever posting ID.'],
        ];
    }

    /**
     * Execute the Lever posting detail request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success($this->service->getPosting(
                $this->requireString($args, 'site'),
                $this->requireString($args, 'posting_id'),
            ));
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
