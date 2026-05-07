<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\CloudConvert\CloudConvertService;

/**
 * Create a CloudConvert signed URL for on-demand conversions.
 */
class CloudConvertCreateSignedUrl implements Tool
{
    /**
     * @param  CloudConvertService  $service  The CloudConvert API client.
     */
    public function __construct(
        private CloudConvertService $service,
    ) {}

    public function name(): string
    {
        return 'cloudconvert_create_signed_url';
    }

    public function description(): string
    {
        return 'Create a CloudConvert signed URL for on-demand conversions.';
    }

    public function parameters(): array
    {
        return [
            'signed_url_base' => ['type' => 'string', 'required' => true, 'description' => 'Signed URL base from CloudConvert signed URL settings.'],
            'signing_secret' => ['type' => 'string', 'required' => true, 'description' => 'Signing secret for the signed URL base.'],
            'job' => ['type' => 'object', 'required' => true, 'description' => 'CloudConvert job payload with tasks and an export/url task.'],
            'cache_key' => ['type' => 'string', 'required' => false, 'description' => 'Optional cache key to reuse output for 24 hours.'],
        ];
    }

    /**
     * Generate the signed URL locally.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            foreach (['signed_url_base', 'signing_secret', 'job'] as $field) {
                if (!array_key_exists($field, $args) || $args[$field] === '' || $args[$field] === null) {
                    return ToolResult::error("{$field} is required.");
                }
            }

            return ToolResult::success([
                'url' => $this->service->createSignedUrl(
                    (string) $args['signed_url_base'],
                    (string) $args['signing_secret'],
                    (array) $args['job'],
                    isset($args['cache_key']) ? (string) $args['cache_key'] : null,
                ),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
