<?php

namespace OpenCompany\Integrations\Recaptcha\Tools;

use OpenCompany\Integrations\Recaptcha\RecaptchaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GetKey implements Tool
{
    public function __construct(
        private RecaptchaService $service,
    ) {}

    public function name(): string
    {
        return 'recaptcha_get_key';
    }

    public function description(): string
    {
        return 'Get a reCAPTCHA Enterprise site key by its full resource name. Returns the key configuration including web, Android, and iOS settings.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The full key resource name, e.g. "projects/my-project/keys/my-key-id".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $name = $args['name'] ?? null;
            if (!$name) {
                return ToolResult::error('name is required. Provide the full key resource name, e.g. "projects/my-project/keys/my-key-id".');
            }

            $result = $this->service->getKey($name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
