<?php

namespace OpenCompany\Integrations\Linkedin\Tools;

use OpenCompany\Integrations\Linkedin\LinkedinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a LinkedIn organization by ID.
 *
 * Returns the full organization profile including name, description, and metadata.
 */
class LinkedinGetOrganization implements Tool
{
    /**
     * @param  LinkedinService  $service  The LinkedIn API client
     */
    public function __construct(
        private LinkedinService $service,
    ) {}

    public function name(): string
    {
        return 'linkedin_get_organization';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a LinkedIn organization (company page) by its ID.
        Returns the organization's name, description, website, and other profile data.
        MD;
    }

    public function parameters(): array
    {
        return [
            'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'LinkedIn organization ID or URN (e.g. "12345" or "urn:li:organization:12345").'],
        ];
    }

    /**
     * Retrieve a LinkedIn organization by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (organization_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $id = $args['organization_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('organization_id is required.');
            }

            // Strip URN prefix if provided
            if (str_starts_with($id, 'urn:li:organization:')) {
                $id = substr($id, strlen('urn:li:organization:'));
            }

            $result = $this->service->getOrganization($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
