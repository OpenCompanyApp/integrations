<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

use OpenCompany\Integrations\FreshworksCrm\FreshworksCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a Freshworks CRM deal by ID.
 */
class FreshworksCrmGetDeal implements Tool
{
    /**
     * @param  FreshworksCrmService  $service  The Freshworks CRM API client.
     */
    public function __construct(
        private FreshworksCrmService $service,
    ) {}

    public function name(): string
    {
        return 'freshworks_crm_get_deal';
    }

    public function description(): string
    {
        return 'Get a single deal from Freshworks CRM by ID. Returns full deal details including amount, stage, associated contacts, and custom fields.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The deal ID.'],
        ];
    }

    /**
     * Fetch a Freshworks CRM deal.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshworks CRM integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Deal ID is required.');
            }

            $result = $this->service->getDeal((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
