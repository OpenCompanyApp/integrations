<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MailerSend\MailerSendService;

/**
 * Base class for MailerSend REST endpoint tools.
 *
 * Handles credential checks, required argument validation, endpoint path
 * interpolation, and query/body shaping for one API operation.
 */
abstract class AbstractMailerSendEndpointTool implements Tool
{
    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [];

    /** @var list<string> */
    protected array $required = [];

    /** @var list<string> */
    protected array $queryParams = [];

    /** @var list<string> */
    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/';

    protected string $toolName = '';

    protected string $toolDescription = '';

    /**
     * @param  MailerSendService  $service  The MailerSend API client.
     */
    public function __construct(
        protected MailerSendService $service,
    ) {}

    public function name(): string
    {
        return $this->toolName;
    }

    public function description(): string
    {
        return $this->toolDescription;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }

    /**
     * Execute one MailerSend REST operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerSend integration is not configured.');
            }

            foreach ($this->required as $field) {
                if (!array_key_exists($field, $args) || $args[$field] === '' || $args[$field] === null) {
                    return ToolResult::error("{$field} is required.");
                }
            }

            $path = $this->interpolatePath($args);
            $query = $this->pick($args, $this->queryParams);
            $body = $this->pick($args, $this->bodyParams);

            $result = match ($this->method) {
                'GET' => $this->service->apiGet($path, $query),
                'POST' => $this->service->apiPost($path, $body, $query),
                'PUT' => $this->service->apiPut($path, $body, $query),
                'DELETE' => $this->service->apiDelete($path, $body, $query),
                default => throw new \RuntimeException("Unsupported MailerSend tool method: {$this->method}"),
            };

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Replace {param} placeholders in the endpoint path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function interpolatePath(array $args): string
    {
        return preg_replace_callback('/\{([a-zA-Z0-9_]+)\}/', function (array $matches) use ($args): string {
            $key = $matches[1];

            if (!array_key_exists($key, $args) || $args[$key] === '' || $args[$key] === null) {
                throw new \RuntimeException("{$key} is required.");
            }

            return rawurlencode((string) $args[$key]);
        }, $this->path) ?? $this->path;
    }

    /**
     * Pick non-empty values from the argument array.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  list<string>  $fields  Fields to copy.
     * @return array<string, mixed>
     */
    private function pick(array $args, array $fields): array
    {
        $values = [];

        foreach ($fields as $field) {
            if (array_key_exists($field, $args) && $args[$field] !== null && $args[$field] !== '') {
                $values[$field] = $args[$field];
            }
        }

        return $values;
    }
}
