<?php

namespace OpenCompany\Integrations\Mistral\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mistral\MistralService;

/**
 * Shared executor for Mistral endpoint-specific tools.
 *
 * Keeps configured-state checks, path validation, query/body shaping, optional
 * multipart uploads, and error conversion consistent across Mistral tools.
 */
abstract class AbstractMistralTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const FILE_UPLOAD = false;
    protected const FILE_FIELD = 'file';

    /**
     * @param  MistralService  $service  Mistral API client.
     */
    public function __construct(
        protected MistralService $service,
    ) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        return static::PARAMETERS;
    }

    /**
     * Execute the mapped Mistral API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mistral integration is not configured.');
            }

            return ToolResult::success($this->service->request(
                static::METHOD,
                $this->path($args),
                $this->query($args),
                $this->body($args),
                $this->filePath($args),
                static::FILE_FIELD,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Fill path placeholders from required tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function path(array $args): string
    {
        $path = static::PATH;

        foreach (static::PATH_PARAMS as $param) {
            $path = str_replace('{' . $param . '}', rawurlencode($this->requireString($args, $param)), $path);
        }

        return $path;
    }

    /**
     * Extract query parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function query(array $args): array
    {
        return isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
    }

    /**
     * Extract JSON or multipart fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function body(array $args): array
    {
        $body = $args['body'] ?? [];

        if (static::BODY_REQUIRED && (!is_array($body) || $body === [])) {
            throw new InvalidArgumentException('body must be a non-empty object matching the Mistral API request schema.');
        }

        if ($body !== [] && !is_array($body)) {
            throw new InvalidArgumentException('body must be an object.');
        }

        return $body;
    }

    /**
     * Extract optional upload path for multipart endpoints.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function filePath(array $args): ?string
    {
        if (!static::FILE_UPLOAD) {
            return null;
        }

        return $this->requireString($args, 'file_path');
    }

    /**
     * Ensure a required string argument exists.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireString(array $args, string $key): string
    {
        $value = $args[$key] ?? null;

        if (!is_string($value) || trim($value) === '') {
            throw new InvalidArgumentException($key . ' must be a non-empty string.');
        }

        return $value;
    }
}
