<?php

namespace OpenCompany\Integrations\Recaptcha\Tools;

use OpenCompany\Integrations\Recaptcha\RecaptchaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GetAssessment implements Tool
{
    public function __construct(
        private RecaptchaService $service,
    ) {}

    public function name(): string
    {
        return 'recaptcha_get_assessment';
    }

    public function description(): string
    {
        return 'Get a single reCAPTCHA Enterprise assessment by its full resource name. Returns the score, token properties, event details, and risk analysis.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The full assessment resource name, e.g. "projects/my-project/assessments/12345678".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $name = $args['name'] ?? null;
            if (!$name) {
                return ToolResult::error('name is required. Provide the full assessment resource name, e.g. "projects/my-project/assessments/12345678".');
            }

            $result = $this->service->getAssessment($name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
