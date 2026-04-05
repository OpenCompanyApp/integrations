<?php

namespace OpenCompany\Integrations\Close\Tools;

use OpenCompany\Integrations\Close\CloseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create Lead.
 *
 * Creates a new lead in Close CRM with an optional name and contacts array.
 * Contacts can include name, email addresses, and phone numbers.
 *
 * @see https://developer.close.com/resources/leads/#create-a-lead
 */
class CloseCreateLead implements Tool
{
    /**
     * @param  CloseService  $service  The Close API service instance.
     */
    public function __construct(
        private CloseService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'close_create_lead';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Create a new lead in Close CRM. Provide a company name and optionally add contacts with email addresses and phone numbers.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Company or lead name.'],
            'contacts' => ['type' => 'array', 'description' => 'Array of contact objects. Each contact can have "name" (string), "emails" (array of objects with "email" and optional "type"), and "phones" (array of objects with "phone" and optional "type").'],
            'url' => ['type' => 'string', 'description' => 'Company website URL.'],
            'status_id' => ['type' => 'string', 'description' => 'Status ID to assign (omit for default status).'],
            'custom' => ['type' => 'object', 'description' => 'Custom field values as an object (e.g., {"Industry": "SaaS"}).'],
        ];
    }

    /**
     * Execute the create lead tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, contacts, url, etc.).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Close integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('Lead name is required.');
            }

            $contacts = $args['contacts'] ?? [];
            $extra    = [];

            if (isset($args['url'])) {
                $extra['url'] = $args['url'];
            }
            if (isset($args['status_id'])) {
                $extra['status_id'] = $args['status_id'];
            }
            if (isset($args['custom'])) {
                $extra['custom'] = $args['custom'];
            }

            $result = $this->service->createLead($name, $contacts, $extra);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
