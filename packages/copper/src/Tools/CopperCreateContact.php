<?php

namespace OpenCompany\Integrations\Copper\Tools;

use OpenCompany\Integrations\Copper\CopperService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a person record in Copper CRM.
 */
class CopperCreateContact implements Tool
{
    /**
     * @param  CopperService  $service  The Copper API client.
     */
    public function __construct(
        private CopperService $service,
    ) {}

    public function name(): string
    {
        return 'copper_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in Copper CRM. Provide at least a name.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Full name of the contact.'],
            'email' => ['type' => 'string', 'description' => 'Email address of the contact.'],
        ];
    }

    /**
     * Create a Copper person.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Copper integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Contact name is required.');
            }

            $data = ['name' => $args['name']];

            if (isset($args['email'])) {
                $data['emails'] = [['email' => $args['email'], 'category' => 'work']];
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
