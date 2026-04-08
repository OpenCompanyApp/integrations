<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

use OpenCompany\Integrations\AmazonSes\AmazonSesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AmazonSesGetTemplate implements Tool
{
    public function __construct(
        private AmazonSesService $service,
    ) {}

    public function name(): string
    {
        return 'amazonses_get_template';
    }

    public function description(): string
    {
        return 'Retrieve an email template from Amazon SES by its name. Returns the template subject, HTML body, and text body.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the email template to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amazon SES integration is not configured.');
            }

            $result = $this->service->getTemplate($args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
