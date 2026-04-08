<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ElasticEmailGetTemplate implements Tool
{
    public function __construct(
        private ElasticEmailService $service,
    ) {}

    public function name(): string
    {
        return 'elasticemail_get_template';
    }

    public function description(): string
    {
        return 'Get details of a specific email template by its ID from Elastic Email.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The template ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Elastic Email integration is not configured.');
            }

            $result = $this->service->getTemplate($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
