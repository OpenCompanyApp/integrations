<?php

namespace OpenCompany\Integrations\Postman\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Postman\PostmanService;

/** Shared executor for documented Postman operation tools. */
abstract class AbstractPostmanTool implements Tool
{
    protected const OPERATION = '';
    /** @param PostmanService $service Postman API client. */
    public function __construct(protected PostmanService $service) {}
    public function name(): string { return 'postman_'.static::OPERATION; }
    public function description(): string { return (string) $this->definition()[5]; }
    public function parameters(): array { $parameters = []; foreach ($this->definition()[2] as $field) { $parameters[(string) $field] = ['type' => 'string', 'required' => true, 'description' => str_replace('_', ' ', ucfirst((string) $field)).'.']; } $parameters['payload'] = ['type' => 'object', 'description' => 'Additional query or JSON body fields.']; return $parameters; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { try { return ToolResult::success($this->service->call(static::OPERATION, $this->payload($args))); } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); } }
    /** @param array<string, mixed> $args @return array<string, mixed> */
    private function payload(array $args): array { $payload = isset($args['payload']) && is_array($args['payload']) ? $args['payload'] : []; foreach ($args as $key => $value) { if ($key !== 'payload') { $payload[$key] = $value; } } return $payload; }
    /** @return array<int, mixed> */
    private function definition(): array { $definition = PostmanService::operations()[static::OPERATION] ?? null; if ($definition === null) { throw new \RuntimeException('Unknown Postman operation: '.static::OPERATION); } return $definition; }
}
