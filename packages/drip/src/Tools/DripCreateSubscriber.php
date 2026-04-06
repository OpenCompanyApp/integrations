<?php

namespace OpenCompany\Integrations\Drip\Tools;

use OpenCompany\Integrations\Drip\DripService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DripCreateSubscriber implements Tool
{
    public function __construct(
        private DripService $service,
    ) {}

    public function name(): string
    {
        return 'drip_create_subscriber';
    }

    public function description(): string
    {
        return 'Create or update a subscriber in Drip. Requires an email address. Optionally provide first name, last name, custom fields, and tags. If a subscriber with this email already exists, their record will be updated.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber\'s email address.'],
            'first_name' => ['type' => 'string', 'description' => 'The subscriber\'s first name.'],
            'last_name' => ['type' => 'string', 'description' => 'The subscriber\'s last name.'],
            'custom_fields' => ['type' => 'object', 'description' => 'Custom field values as key-value pairs (e.g., {"Company": "Acme"}).'],
            'tags' => ['type' => 'array', 'description' => 'Tags to apply to the subscriber (e.g., ["lead", "newsletter"]).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Drip integration is not configured. Provide an API key and account ID.');
            }

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('Email address is required.');
            }

            $options = [];

            if (isset($args['first_name'])) {
                $options['first_name'] = $args['first_name'];
            }

            if (isset($args['last_name'])) {
                $options['last_name'] = $args['last_name'];
            }

            if (isset($args['custom_fields']) && is_array($args['custom_fields'])) {
                $options['custom_fields'] = $args['custom_fields'];
            }

            if (isset($args['tags']) && is_array($args['tags'])) {
                $options['tags'] = $args['tags'];
            }

            $result = $this->service->createSubscriber($email, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
