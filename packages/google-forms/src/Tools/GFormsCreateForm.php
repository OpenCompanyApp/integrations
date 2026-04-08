<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

use OpenCompany\Integrations\GoogleForms\GoogleFormsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GFormsCreateForm implements Tool
{
    public function __construct(
        private GoogleFormsService $service,
    ) {}

    public function name(): string
    {
        return 'gforms_create_form';
    }

    public function description(): string
    {
        return 'Create a new Google Form. Provide a title and optional description. The form will appear in the authenticated user\'s Google Drive.';
    }

    public function parameters(): array
    {
        return [
            'info' => ['type' => 'object', 'description' => 'Full form info object (JSON). Use this for advanced form creation with questions pre-configured.'],
            'title' => ['type' => 'string', 'description' => 'The title of the form. Shown at the top of the form.'],
            'description' => ['type' => 'string', 'description' => 'A description of the form\'s purpose. Shown below the title.'],
            'documentTitle' => ['type' => 'string', 'description' => 'The title shown in Google Drive. Defaults to the form title if not set.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Forms integration is not configured.');
            }

            $info = [];
            if (isset($args['info']) && is_array($args['info'])) {
                $info = $args['info'];
            }

            $result = $this->service->createForm(
                info: $info,
                title: $args['title'] ?? null,
                description: $args['description'] ?? null,
                documentTitle: $args['documentTitle'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
