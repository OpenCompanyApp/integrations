<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new mailing list in Mailgun.
 *
 * Requires an address. Optionally include a name and description.
 */
class MailgunCreateMailingList implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_create_mailing_list';
    }

    public function description(): string
    {
        return 'Create a new mailing list in Mailgun. Requires an address. Optionally include a name and description.';
    }

    public function parameters(): array
    {
        return [
            'address'     => ['type' => 'string', 'required' => true, 'description' => 'Email address for the mailing list (e.g. newsletter@mg.example.com).'],
            'name'        => ['type' => 'string', 'description' => 'Display name for the mailing list.'],
            'description' => ['type' => 'string', 'description' => 'Description of the mailing list.'],
        ];
    }

    /**
     * Create a new mailing list in Mailgun.
     *
     * @param  array<string, mixed>  $args  Tool arguments (address, name, description)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $address = $args['address'] ?? '';

            if (empty($address)) {
                return ToolResult::error('address is required.');
            }

            $data = ['address' => $address];

            if (! empty($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (! empty($args['description'])) {
                $data['description'] = $args['description'];
            }

            $result = $this->service->createMailingList($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
