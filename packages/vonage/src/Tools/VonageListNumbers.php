<?php

namespace OpenCompany\Integrations\Vonage\Tools;

use OpenCompany\Integrations\Vonage\VonageService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VonageListNumbers implements Tool
{
    /**
     * Create a new VonageListNumbers tool instance.
     */
    public function __construct(
        private VonageService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'vonage_list_numbers';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List phone numbers purchased on your Vonage account. Optionally filter by pattern.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'pattern' => ['type' => 'string', 'description' => 'A pattern to search for in the phone numbers.'],
            'search_pattern' => ['type' => 'integer', 'description' => 'How to match the pattern: 0 = starts with, 1 = contains, 2 = ends with.'],
            'size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 10).'],
            'index' => ['type' => 'integer', 'description' => 'Page index for pagination (1-based).'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vonage integration is not configured.');
            }

            $params = [];

            if (isset($args['pattern'])) {
                $params['pattern'] = $args['pattern'];
            }
            if (isset($args['search_pattern'])) {
                $params['search_pattern'] = (int) $args['search_pattern'];
            }
            if (isset($args['size'])) {
                $params['size'] = (int) $args['size'];
            }
            if (isset($args['index'])) {
                $params['index'] = (int) $args['index'];
            }

            $result = $this->service->listNumbers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
