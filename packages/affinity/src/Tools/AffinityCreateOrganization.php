<?php

namespace OpenCompany\Integrations\Affinity\Tools;

use OpenCompany\Integrations\Affinity\AffinityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new organization in Affinity CRM.
 *
 * Creates an organization with the provided name and optional domain.
 * The organization will appear in the Affinity workspace.
 */
class AffinityCreateOrganization implements Tool
{
    /**
     * Create a new AffinityCreateOrganization tool instance.
     *
     * @param  AffinityService  $service  The Affinity API service.
     */
    public function __construct(
        private AffinityService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'affinity_create_organization';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Create a new organization in Affinity CRM. Provide a name (required) and optionally a domain.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The organization\'s name.'],
            'domain' => ['type' => 'string', 'description' => 'The organization\'s website domain (e.g., "example.com").'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Affinity integration is not configured.');
            }

            $data = [
                'name' => $args['name'],
            ];

            if (isset($args['domain'])) {
                $data['domain'] = $args['domain'];
            }

            $result = $this->service->createOrganization($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
