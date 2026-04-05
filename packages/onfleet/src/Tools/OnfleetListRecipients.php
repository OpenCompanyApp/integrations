<?php

namespace OpenCompany\Integrations\Onfleet\Tools;

use OpenCompany\Integrations\Onfleet\OnfleetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List recipients (delivery customers) from Onfleet.
 *
 * Supports searching by name, phone, or email. Returns recipient contact
 * details and associated task history.
 */
class OnfleetListRecipients implements Tool
{
    public function __construct(
        private OnfleetService $service,
    ) {}

    public function name(): string
    {
        return 'onfleet_list_recipients';
    }

    public function description(): string
    {
        return 'List recipients (delivery customers) from Onfleet. Search by name, phone, or email. Returns recipient contact details.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'Filter recipients by name.'],
            'phone' => ['type' => 'string', 'description' => 'Filter recipients by phone number.'],
            'email' => ['type' => 'string', 'description' => 'Filter recipients by email address.'],
            'query' => ['type' => 'string', 'description' => 'General search query for recipients.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Onfleet integration is not configured.');
            }

            $query = [];
            if (isset($args['name'])) {
                $query['name'] = $args['name'];
            }
            if (isset($args['phone'])) {
                $query['phone'] = $args['phone'];
            }
            if (isset($args['email'])) {
                $query['email'] = $args['email'];
            }
            if (isset($args['query'])) {
                $query['query'] = $args['query'];
            }

            $result = $this->service->listRecipients($query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
