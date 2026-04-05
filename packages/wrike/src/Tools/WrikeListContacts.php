<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List contacts in Wrike.
 */
class WrikeListContacts implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts in Wrike.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Max number of contacts to return.'],
        ];
    }

    /**
     * Retrieve a list of contacts.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $contacts = $this->service->listContacts($params);

            return ToolResult::success($contacts);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
