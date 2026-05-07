<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\CloudConvert\CloudConvertService;

/**
 * Verify a CloudConvert webhook HMAC signature.
 */
class CloudConvertVerifyWebhookSignature implements Tool
{
    /**
     * @param  CloudConvertService  $service  The CloudConvert API client.
     */
    public function __construct(
        private CloudConvertService $service,
    ) {}

    public function name(): string
    {
        return 'cloudconvert_verify_webhook_signature';
    }

    public function description(): string
    {
        return 'Verify a CloudConvert webhook HMAC signature.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'string', 'required' => true, 'description' => 'Raw webhook request body.'],
            'signature' => ['type' => 'string', 'required' => true, 'description' => 'CloudConvert-Signature header value.'],
            'signing_secret' => ['type' => 'string', 'required' => true, 'description' => 'Webhook signing secret from CloudConvert webhook settings.'],
        ];
    }

    /**
     * Verify the webhook signature locally.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        foreach (['payload', 'signature', 'signing_secret'] as $field) {
            if (!array_key_exists($field, $args) || $args[$field] === '' || $args[$field] === null) {
                return ToolResult::error("{$field} is required.");
            }
        }

        return ToolResult::success([
            'valid' => $this->service->verifyWebhookSignature(
                (string) $args['payload'],
                (string) $args['signature'],
                (string) $args['signing_secret'],
            ),
        ]);
    }
}
