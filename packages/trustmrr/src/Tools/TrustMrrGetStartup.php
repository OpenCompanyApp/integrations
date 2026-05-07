<?php

namespace OpenCompany\Integrations\TrustMrr\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\TrustMrr\TrustMrrService;

/**
 * Get full details for a single TrustMRR startup.
 *
 * Returns the full startup detail object, including fields that are omitted or truncated in list results.
 */
class TrustMrrGetStartup implements Tool
{
    /**
     * @param  TrustMrrService  $service  The TrustMRR API client.
     */
    public function __construct(
        private TrustMrrService $service,
    ) {}

    public function name(): string
    {
        return 'trustmrr_get_startup';
    }

    public function description(): string
    {
        return 'Get full details for a single startup on TrustMRR by its slug. Returns revenue data, tech stack, cofounders, social metrics, asking price, and more. Use the slug from the list startups tool.';
    }

    public function parameters(): array
    {
        return [
            'slug' => ['type' => 'string', 'required' => true, 'description' => 'The startup\'s URL-friendly identifier (e.g. "shipfast"). Get this from the list startups tool.'],
        ];
    }

    /**
     * Execute the tool and return a startup detail object.
     *
     * @param  array<string, mixed>  $args  Tool arguments (slug).
     */
    public function execute(array $args): ToolResult
    {
        $slug = $args['slug'] ?? '';

        if (empty($slug)) {
            return ToolResult::error('slug is required. Use trustmrr_list_startups to find startup slugs.');
        }

        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('TrustMRR integration is not configured.');
            }

            $result = $this->service->getStartup($slug);

            $startup = $result['data'] ?? $result;

            return ToolResult::success($startup);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
