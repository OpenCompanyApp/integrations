<?php

namespace OpenCompany\Integrations\Plivo\Tools;

use OpenCompany\Integrations\Plivo\PlivoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing phone numbers from the Plivo API.
 *
 * Returns all numbers on the account with optional filtering by number type,
 * service, and pagination parameters.
 *
 * @see https://www.plivo.com/docs/numbers/api/number#list-numbers
 */
class PlivoListNumbers implements Tool
{
    /**
     * Create a new PlivoListNumbers tool instance.
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
        return 'plivo_list_numbers';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List phone numbers on your Plivo account. Supports filtering by number type, service, and pagination.';
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
            'number_type' => ['type' => 'string', 'description' => 'Filter by number type: "local", "tollfree", or "national".'],
            'service' => ['type' => 'string', 'description' => 'Filter by service: "voice", "sms", or "voice,sms".'],
        ];
    }

    /**
     * Execute the list numbers tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments matching the defined parameters.
     * @return ToolResult The result containing number records or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plivo integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['limit', 'offset', 'number_type', 'service'];

            foreach ($filterKeys as $key) {
                if (isset($args[$key])) {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listNumbers($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
