<?php

namespace OpenCompany\Integrations\LemonSqueezy\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generic list tool for supported Lemon Squeezy JSON:API resources.
 */
class LemonSqueezyListResource extends AbstractLemonSqueezyTool
{
    public const RESOURCE = '';
    public const TOOL_NAME = '';

    public function name(): string { return static::TOOL_NAME; }
    public function description(): string { return 'List Lemon Squeezy '.static::RESOURCE.'.'; }
    public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters such as filters, include, page[size], and page[number].']]; }
    /** @param array<string, mixed> $args Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listResource(static::RESOURCE, $this->objectArg($args, 'params'))); }
}
