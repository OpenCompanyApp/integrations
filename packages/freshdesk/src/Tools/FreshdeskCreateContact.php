<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new customer contact in Freshdesk.
 */
class FreshdeskCreateContact implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_create_contact';
    }

    public function description(): string
    {
        return 'Create a new customer contact in Freshdesk. Requires an email address and name.';
    }

    public function parameters(): array
    {
        return [
            'email'      => ['type' => 'string', 'required' => true, 'description' => 'Email address of the contact.'],
            'name'       => ['type' => 'string', 'required' => true, 'description' => 'Full name of the contact.'],
            'phone'      => ['type' => 'string', 'description' => 'Phone number.'],
            'mobile'     => ['type' => 'string', 'description' => 'Mobile number.'],
            'company_id' => ['type' => 'integer', 'description' => 'ID of the company to associate.'],
            'job_title'  => ['type' => 'string', 'description' => 'Job title.'],
            'tags'       => ['type' => 'array', 'description' => 'Array of tags.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshdesk integration is not configured.');
            }

            if (empty($args['email']) || empty($args['name'])) {
                return ToolResult::error('email and name are required.');
            }

            $data = array_filter([
                'email'      => $args['email'],
                'name'       => $args['name'],
                'phone'      => $args['phone'] ?? null,
                'mobile'     => $args['mobile'] ?? null,
                'company_id' => $args['company_id'] ?? null,
                'job_title'  => $args['job_title'] ?? null,
                'tags'       => $args['tags'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
