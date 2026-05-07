<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MicrosoftOneNote\MicrosoftOneNoteService;

/**
 * Shared executor for generated Microsoft OneNote tools.
 *
 * Handles configured-state checks, path/query/header mapping, JSON or raw body
 * validation, dispatch, and error conversion for endpoint-specific operations.
 */
abstract class AbstractMicrosoftOneNoteTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';

    /** @param  MicrosoftOneNoteService  $service  Microsoft OneNote API client. */
    public function __construct(protected MicrosoftOneNoteService $service) {}
    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return static::PARAMETERS; }

    /** @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint. */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) { return ToolResult::error('Microsoft OneNote access token is required.'); }
            return ToolResult::success($this->service->request(static::METHOD, static::PATH, $this->mapped($args, static::PATH_PARAMS, true), $this->mapped($args, static::QUERY_PARAMS), $this->headers($args), $this->body($args), static::BODY_MODE));
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }

    /** @param  array<string, mixed>  $args  Tool arguments. @param  array<string, string>  $map  Official parameter name to tool key map. @return array<string, mixed> */
    private function mapped(array $args, array $map, bool $required = false): array { $out = []; foreach ($map as $official => $key) { if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') { if ($required) { throw new InvalidArgumentException($key.' must be a non-empty parameter.'); } continue; } $out[$official] = $args[$key]; } return $out; }
    /** @param  array<string, mixed>  $args  Tool arguments. @return array<string, string> */
    private function headers(array $args): array { return isset($args['prefer']) && $args['prefer'] !== '' ? ['Prefer' => (string) $args['prefer']] : []; }
    /** @param  array<string, mixed>  $args  Tool arguments. @return array<string, mixed> */
    private function body(array $args): array { $body = $args['body'] ?? []; if ($body !== [] && !is_array($body)) { throw new InvalidArgumentException('body must be an object.'); } if (static::BODY_REQUIRED && (!is_array($body) || $body === [])) { throw new InvalidArgumentException('body must be a non-empty object matching the Microsoft OneNote request schema.'); } if (static::BODY_MODE === 'raw' && static::BODY_REQUIRED && !array_key_exists('content', $body)) { throw new InvalidArgumentException('body.content must be provided for raw OneNote content operations.'); } return $body; }
}
