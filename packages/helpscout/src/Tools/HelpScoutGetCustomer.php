<?php

namespace OpenCompany\Integrations\HelpScout\Tools;

use OpenCompany\Integrations\HelpScout\HelpScoutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HelpScoutGetCustomer implements Tool
{
    /**
     * @param  HelpScoutService  $service  The HelpScout API service instance.
     */
    public function __construct(
        private HelpScoutService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'helpscout_get_customer';
    }

    /**
     * A description of what the tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Get full details of a specific HelpScout customer, including contact info, social profiles, and custom fields.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The customer ID.'],
        ];
    }

    /**
     * Execute the tool call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('HelpScout integration is not configured.');
            }

            $result = $this->service->getCustomer((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
