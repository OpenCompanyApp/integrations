<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current Phantombuster organization.
 */
class PhantombusterGetOrganization extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_get_organization';
    }

    public function description(): string
    {
        return 'Get current Phantombuster organization metadata and optional configuration details.';
    }

    public function parameters(): array
    {
        return [
            'with_global_object' => ['type' => 'boolean', 'description' => 'Include the organization global object.'],
            'with_proxies' => ['type' => 'boolean', 'description' => 'Include organization proxies.'],
            'with_crm_integrations' => ['type' => 'boolean', 'description' => 'Include CRM integration metadata.'],
            'with_custom_prompts' => ['type' => 'boolean', 'description' => 'Include custom prompt metadata.'],
        ];
    }

    /**
     * Fetch organization metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->getOrganization($this->only($args, [
                'with_global_object' => 'withGlobalObject',
                'with_proxies' => 'withProxies',
                'with_crm_integrations' => 'withCrmIntegrations',
                'with_custom_prompts' => 'withCustomPrompts',
            ])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
