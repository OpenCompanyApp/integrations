<?php

namespace OpenCompany\Integrations\Vonage\Tools;

use OpenCompany\Integrations\Vonage\VonageService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VonageListApplications implements Tool
{
    /**
     * Create a new VonageListApplications tool instance.
     */
    public function __construct(
        private VonageService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'vonage_list_applications';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List Vonage applications configured on your account. Applications define how Vonage handles calls and messages.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of applications per page (default: 10).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
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

            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listApplications($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
