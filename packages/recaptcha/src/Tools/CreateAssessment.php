<?php

namespace OpenCompany\Integrations\Recaptcha\Tools;

use OpenCompany\Integrations\Recaptcha\RecaptchaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CreateAssessment implements Tool
{
    public function __construct(
        private RecaptchaService $service,
    ) {}

    public function name(): string
    {
        return 'recaptcha_create_assessment';
    }

    public function description(): string
    {
        return 'Create a reCAPTCHA Enterprise assessment to evaluate a reCAPTCHA token. Provide the project parent, the token to evaluate, and the site key. Returns score, token validity, and action verification.';
    }

    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'required' => true, 'description' => 'The project resource name, e.g. "projects/my-project".'],
            'token' => ['type' => 'string', 'required' => true, 'description' => 'The reCAPTCHA token to evaluate (obtained from the client-side widget).'],
            'site_key' => ['type' => 'string', 'required' => true, 'description' => 'The reCAPTCHA Enterprise site key associated with the token.'],
            'expected_action' => ['type' => 'string', 'required' => false, 'description' => 'The expected action name for action-based verification (e.g. "LOGIN", "SIGNUP").'],
            'hashed_account_id' => ['type' => 'string', 'required' => false, 'description' => 'Optional hashed user account ID for account defender assessment.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $parent = $args['parent'] ?? null;
            if (!$parent) {
                return ToolResult::error('parent is required. Provide the project resource name, e.g. "projects/my-project".');
            }

            $token = $args['token'] ?? null;
            if (!$token) {
                return ToolResult::error('token is required. Provide the reCAPTCHA token from the client-side widget.');
            }

            $siteKey = $args['site_key'] ?? null;
            if (!$siteKey) {
                return ToolResult::error('site_key is required. Provide the reCAPTCHA Enterprise site key.');
            }

            $payload = [
                'event' => [
                    'token' => $token,
                    'siteKey' => $siteKey,
                ],
            ];

            if (!empty($args['expected_action'])) {
                $payload['event']['expectedAction'] = $args['expected_action'];
            }

            if (!empty($args['hashed_account_id'])) {
                $payload['event']['hashedAccountId'] = $args['hashed_account_id'];
            }

            $result = $this->service->createAssessment($parent, $payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
