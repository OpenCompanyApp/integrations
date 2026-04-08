<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a bounce (suppression) for an address on a Mailgun domain.
 *
 * Prevents future email delivery to the specified address.
 */
class MailgunCreateSuppression implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_create_suppression';
    }

    public function description(): string
    {
        return 'Create a bounce (suppression) for an address on a Mailgun domain. Prevents future email delivery to that address.';
    }

    public function parameters(): array
    {
        return [
            'domain'  => ['type' => 'string', 'description' => 'Domain to add the suppression to. Defaults to the configured sending domain.'],
            'address' => ['type' => 'string', 'required' => true, 'description' => 'Email address to suppress.'],
            'code'    => ['type' => 'integer', 'description' => 'Bounce code (e.g. 550).'],
            'error'   => ['type' => 'string', 'description' => 'Error message for the bounce.'],
        ];
    }

    /**
     * Create a bounce (suppression) for an address on a Mailgun domain.
     *
     * @param  array<string, mixed>  $args  Tool arguments (domain, address, code, error)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $domain = $args['domain'] ?? '';
            $address = $args['address'] ?? '';

            if (empty($domain)) {
                return ToolResult::error('domain is required.');
            }
            if (empty($address)) {
                return ToolResult::error('address is required.');
            }

            $data = ['address' => $address];

            if (array_key_exists('code', $args)) {
                $data['code'] = (int) $args['code'];
            }
            if (! empty($args['error'])) {
                $data['error'] = $args['error'];
            }

            $result = $this->service->createSuppression($domain, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
