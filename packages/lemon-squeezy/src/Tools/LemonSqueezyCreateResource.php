<?php

namespace OpenCompany\Integrations\LemonSqueezy\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generic create tool for supported Lemon Squeezy JSON:API resources.
 */
class LemonSqueezyCreateResource extends AbstractLemonSqueezyTool
{
    public const RESOURCE = '';
    public const TOOL_NAME = '';

    public function name(): string { return static::TOOL_NAME; }
    public function description(): string { return 'Create a Lemon Squeezy '.static::RESOURCE.' resource.'; }
    public function parameters(): array { return ['attributes' => ['type' => 'object', 'required' => true, 'description' => 'JSON:API attributes object.'], 'relationships' => ['type' => 'object', 'description' => 'Optional JSON:API relationships object.']]; }
    /** @param array<string, mixed> $args Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createResource(static::RESOURCE, $this->objectArg($args, 'attributes'), $this->objectArg($args, 'relationships'))); }
}
