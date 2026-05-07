<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenAlex\OpenAlexService;

/**
 * List available OpenAlex changefile dates.
 */
class OpenAlexListChangefiles implements Tool
{
    /**
     * @param  OpenAlexService  $service  OpenAlex API client.
     */
    public function __construct(private OpenAlexService $service) {}

    public function name(): string
    {
        return 'openalex_list_changefiles';
    }

    public function description(): string
    {
        return 'List available OpenAlex changefile dates. Changefile access may require a paid OpenAlex plan.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the OpenAlex changefile dates endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success($this->service->listChangefiles());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
