<?php

namespace OpenCompany\Integrations\HelpScout\Tools;

use OpenCompany\Integrations\HelpScout\HelpScoutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HelpScoutCreateCustomer implements Tool
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
        return 'helpscout_create_customer';
    }

    /**
     * A description of what the tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Create a new customer in HelpScout. Provide at least a name or email address.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'Customer first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Customer last name.'],
            'email' => ['type' => 'string', 'description' => 'Primary email address for the customer.'],
            'organization' => ['type' => 'string', 'description' => 'Company or organization name.'],
            'job_title' => ['type' => 'string', 'description' => 'Job title.'],
            'phone' => ['type' => 'string', 'description' => 'Phone number.'],
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

            $data = [];

            if (isset($args['first_name'])) {
                $data['firstName'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['lastName'] = $args['last_name'];
            }
            if (isset($args['email'])) {
                $data['emails'] = [['type' => 'work', 'value' => $args['email']]];
            }
            if (isset($args['organization'])) {
                $data['organization'] = $args['organization'];
            }
            if (isset($args['job_title'])) {
                $data['jobTitle'] = $args['job_title'];
            }
            if (isset($args['phone'])) {
                $data['phones'] = [['type' => 'work', 'value' => $args['phone']]];
            }

            if (empty($data)) {
                return ToolResult::error('At least one of first_name, last_name, or email is required.');
            }

            $result = $this->service->createCustomer($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
