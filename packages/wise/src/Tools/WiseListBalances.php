<?php

namespace OpenCompany\Integrations\Wise\Tools;

use OpenCompany\Integrations\Wise\WiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list multi-currency account balances for a Wise profile.
 *
 * Returns all currency balances held in the borderless account, including
 * available amounts, reserved amounts, and currency codes.
 */
class WiseListBalances implements Tool
{
    /**
     * Create a new WiseListBalances instance.
     *
     * @param WiseService $service The Wise API service client.
     */
    public function __construct(
        private WiseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'wise_list_balances';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List multi-currency account balances for a Wise profile.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'profile_id' => ['type' => 'integer', 'description' => 'The Wise profile ID to list balances for.', 'required' => true],
        ];
    }

    /**
     * Execute the tool — list balances for a profile.
     *
     * @param array $args Tool arguments containing profile_id.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wise integration is not configured.');
            }

            $profileId = $args['profile_id'] ?? null;

            if (empty($profileId)) {
                return ToolResult::error('Parameter "profile_id" is required.');
            }

            $balances = $this->service->listBalances($profileId);

            return ToolResult::success($balances);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
