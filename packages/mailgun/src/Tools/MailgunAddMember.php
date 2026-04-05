<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a member to a Mailgun mailing list.
 *
 * Requires the list address and the member email address. Optionally include name and vars (JSON).
 */
class MailgunAddMember implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_add_member';
    }

    public function description(): string
    {
        return 'Add a member to a Mailgun mailing list. Requires list_address and member address.';
    }

    public function parameters(): array
    {
        return [
            'list_address' => ['type' => 'string', 'required' => true, 'description' => 'Mailing list address (e.g. newsletter@mg.example.com).'],
            'address'      => ['type' => 'string', 'required' => true, 'description' => 'Email address of the member to add.'],
            'name'         => ['type' => 'string', 'description' => 'Display name of the member.'],
            'vars'         => ['type' => 'string', 'description' => 'JSON string of custom variables for the member.'],
        ];
    }

    /**
     * Add a member to a Mailgun mailing list.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_address, address, name, vars)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $listAddress = $args['list_address'] ?? '';
            $address = $args['address'] ?? '';

            if (empty($listAddress)) {
                return ToolResult::error('list_address is required.');
            }
            if (empty($address)) {
                return ToolResult::error('address (member email) is required.');
            }

            $data = ['address' => $address];

            if (! empty($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (! empty($args['vars'])) {
                $data['vars'] = $args['vars'];
            }

            $result = $this->service->addMember($listAddress, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
