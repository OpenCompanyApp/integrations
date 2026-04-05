<?php

namespace OpenCompany\Integrations\LinkedIn\Tools;

use OpenCompany\Integrations\LinkedIn\LinkedInService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a LinkedIn organization's details by its ID.
 *
 * Returns organization information including name, description,
 * website, industry, and other available fields.
 */
class LinkedInGetOrganization implements Tool
{
    /**
     * Create a new LinkedInGetOrganization tool instance.
     *
     * @param  LinkedInService  $service  The LinkedIn API service.
     */
    public function __construct(
        private LinkedInService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'linkedin_get_organization';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return "Get a LinkedIn organization's details by its ID. Returns the organization's name, description, website, and other available information.";
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'The LinkedIn organization ID (e.g., "2414183" from urn:li:organization:2414183).'],
        ];
    }

    /**
     * Execute the tool and return the organization data.
     *
     * @param  array<string, mixed>  $args  Tool arguments including 'organization_id'.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $organizationId = $args['organization_id'] ?? '';
            if (empty(trim($organizationId))) {
                return ToolResult::error('Organization ID is required.');
            }

            $result = $this->service->getOrganization($organizationId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
