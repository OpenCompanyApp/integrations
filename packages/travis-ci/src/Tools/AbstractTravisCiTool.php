<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\TravisCi\TravisCiService;

/**
 * Shared executor for Travis CI tools.
 *
 * Child tools define metadata and operation names while this class validates
 * required arguments, maps query/body data, and dispatches service calls.
 */
abstract class AbstractTravisCiTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  TravisCiService  $service  Travis CI API client.
     */
    public function __construct(protected TravisCiService $service) {}

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
     * Execute the Travis CI operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Travis CI integration is not configured.');
            }

            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            return ToolResult::success($this->dispatch($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Dispatch to the mapped service method.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function dispatch(array $args): array
    {
        return match (static::METHOD) {
            'getCurrentUser' => $this->service->getCurrentUser(),
            'listRepositories' => $this->service->listRepositories($this->query($args)),
            'listOwnerRepositories' => $this->service->listOwnerRepositories((string) ($args['provider'] ?? 'github'), (string) $args['login'], $this->query($args)),
            'getRepository' => $this->service->getRepository((string) $args['repository'], $this->query($args)),
            'activateRepository' => $this->service->activateRepository((string) $args['repository']),
            'deactivateRepository' => $this->service->deactivateRepository((string) $args['repository']),
            'listBuilds' => $this->service->listBuilds($this->query($args)),
            'listRepositoryBuilds' => $this->service->listRepositoryBuilds((string) $args['repository'], $this->query($args)),
            'getBuild' => $this->service->getBuild($args['build_id'], $this->query($args)),
            'cancelBuild' => $this->service->cancelBuild($args['build_id']),
            'restartBuild' => $this->service->restartBuild($args['build_id']),
            'listJobs' => $this->service->listJobs($this->query($args)),
            'listBuildJobs' => $this->service->listBuildJobs($args['build_id'], $this->query($args)),
            'getJob' => $this->service->getJob($args['job_id'], $this->query($args)),
            'cancelJob' => $this->service->cancelJob($args['job_id']),
            'restartJob' => $this->service->restartJob($args['job_id']),
            'debugJob' => $this->service->debugJob($args['job_id']),
            'getJobLog' => $this->service->getJobLog($args['job_id'], (bool) ($args['plain_text'] ?? false), $this->query($args)),
            'listRequests' => $this->service->listRequests((string) $args['repository'], $this->query($args)),
            'createRequest' => $this->service->createRequest((string) $args['repository'], $this->payload($args)),
            'listSettings' => $this->service->listSettings((string) $args['repository'], $this->query($args)),
            'updateSetting' => $this->service->updateSetting((string) $args['repository'], (string) $args['setting'], $this->payload($args)),
            'listEnvVars' => $this->service->listEnvVars((string) $args['repository'], $this->query($args)),
            'createEnvVar' => $this->service->createEnvVar((string) $args['repository'], $this->payload($args)),
            'deleteEnvVar' => $this->service->deleteEnvVar((string) $args['repository'], (string) $args['env_var_id']),
            'apiGet' => $this->service->apiGet((string) $args['path'], $this->query($args)),
            'apiPost' => $this->service->apiPost((string) $args['path'], $this->payload($args)),
            'apiPatch' => $this->service->apiPatch((string) $args['path'], $this->payload($args)),
            'apiDelete' => $this->service->apiDelete((string) $args['path'], $this->query($args)),
            default => throw new InvalidArgumentException('Unsupported Travis CI operation.'),
        };
    }

    /**
     * Return explicit payload object or inferred write fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function payload(array $args): array
    {
        if (isset($args['payload']) && is_array($args['payload'])) {
            return $args['payload'];
        }

        $payload = $args;
        foreach (['repository', 'provider', 'login', 'build_id', 'job_id', 'env_var_id', 'setting', 'path', 'plain_text', 'query', 'payload'] as $key) {
            unset($payload[$key]);
        }

        return $payload;
    }

    /**
     * Return explicit query object or inferred read fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function query(array $args): array
    {
        if (isset($args['query']) && is_array($args['query'])) {
            return $args['query'];
        }

        $query = $args;
        foreach (['repository', 'provider', 'login', 'build_id', 'job_id', 'env_var_id', 'setting', 'path', 'plain_text', 'payload'] as $key) {
            unset($query[$key]);
        }

        return $query;
    }

    /**
     * Ensure a required value is present.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireValue(array $args, string $key): void
    {
        $value = $args[$key] ?? null;
        if ($value === null || $value === '' || (is_array($value) && $value === [])) {
            throw new InvalidArgumentException($key.' is required.');
        }
    }
}
