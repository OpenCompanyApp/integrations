<?php

namespace OpenCompany\Integrations\LemonSqueezy\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generic retrieve tool for supported Lemon Squeezy JSON:API resources.
 */
class LemonSqueezyGetResource extends AbstractLemonSqueezyTool
{
    public const RESOURCE = '';
    public const TOOL_NAME = '';

    public function name(): string { return static::TOOL_NAME; }
    public function description(): string { return 'Retrieve a Lemon Squeezy '.static::RESOURCE.' resource.'; }
    public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.']]; }
    /** @param array<string, mixed> $args Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getResource(static::RESOURCE, $this->requiredString($args, 'id'))); }
}
