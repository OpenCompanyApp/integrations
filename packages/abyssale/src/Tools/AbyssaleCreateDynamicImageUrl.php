<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or retrieve a dynamic image URL for an Abyssale design.
 */
class AbyssaleCreateDynamicImageUrl extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_create_dynamic_image_url';
    }

    public function description(): string
    {
        return 'Create or retrieve a dynamic image URL for an Abyssale design.';
    }

    public function parameters(): array
    {
        return [
            'design_id' => ['type' => 'string', 'required' => true, 'description' => 'The Abyssale design UUID.'],
            'enable_rate_limit' => ['type' => 'boolean', 'description' => 'Enable per-query rate limiting for the dynamic image.'],
            'enable_production_mode' => ['type' => 'boolean', 'description' => 'Enable production mode for the dynamic image.'],
        ];
    }

    /**
     * Execute the create dynamic image URL request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        $payload = [];
        foreach (['enable_rate_limit', 'enable_production_mode'] as $key) {
            if (array_key_exists($key, $args)) {
                $payload[$key] = (bool) $args[$key];
            }
        }

        return $this->run(fn (): array => $this->service->createDynamicImageUrl(
            $this->requiredString($args, 'design_id', 'Design ID'),
            $payload,
        ));
    }
}
