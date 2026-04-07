<?php

namespace OpenCompany\Integrations\Plivo\Tools;

use OpenCompany\Integrations\Plivo\PlivoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing Plivo voice applications.
 *
 * Returns all applications configured in the Plivo account with their
 * names, IDs, answer URLs, hangup URLs, and associated phone numbers.
 *
 * @see https://www.plivo.com/docs/voice/api/application#list-applications
 */
class PlivoListApplications implements Tool
{
    /**
     * Create a new PlivoListApplications tool instance.
     *
     * @param  PlivoService  $service  The Plivo API service instance.
     */
    public function __construct(
        private PlivoService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'plivo_list_applications';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List Plivo voice applications on the account. Returns application IDs, names, answer/hangup URLs, and associated number counts.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default: 20, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the list applications tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments matching the defined parameters.
     * @return ToolResult The result containing application records or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plivo integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['limit', 'offset'];

            foreach ($filterKeys as $key) {
                if (isset($args[$key])) {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listApplications($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
