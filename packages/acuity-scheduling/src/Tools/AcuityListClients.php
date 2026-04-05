<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

use OpenCompany\Integrations\AcuityScheduling\AcuitySchedulingService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AcuityListClients implements Tool
{
    /**
     * Create a new List Clients tool instance.
     */
    public function __construct(
        private AcuitySchedulingService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'acuity_list_clients';
    }

    /**
     * A description of what the tool does, used by AI agents for tool selection.
     */
    public function description(): string
    {
        return 'List clients from Acuity Scheduling. Search by name, email, or phone. Returns client contact information and history.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'search' => ['type' => 'string', 'description' => 'Search query to filter clients by name, email, or phone.'],
            'email' => ['type' => 'string', 'description' => 'Filter clients by exact email address.'],
            'max' => ['type' => 'integer', 'description' => 'Maximum number of clients to return.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Acuity Scheduling integration is not configured.');
            }

            $params = [];
            $filters = ['search', 'email', 'max'];

            foreach ($filters as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listClients($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
