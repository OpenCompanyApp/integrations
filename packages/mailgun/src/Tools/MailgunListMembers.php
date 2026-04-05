<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List members of a Mailgun mailing list.
 *
 * Requires the mailing list address. Supports pagination via limit.
 */
class MailgunListMembers implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_list_members';
    }

    public function description(): string
    {
        return 'List members of a Mailgun mailing list. Requires the list address.';
    }

    public function parameters(): array
    {
        return [
            'list_address' => ['type' => 'string', 'required' => true, 'description' => 'Mailing list address (e.g. newsletter@mg.example.com).'],
            'limit'        => ['type' => 'integer', 'description' => 'Maximum number of members to return (default 100).'],
        ];
    }

    /**
     * List members of a Mailgun mailing list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_address, limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $listAddress = $args['list_address'] ?? '';

            if (empty($listAddress)) {
                return ToolResult::error('list_address is required.');
            }

            $params = [];

            if (! empty($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listMembers($listAddress, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
