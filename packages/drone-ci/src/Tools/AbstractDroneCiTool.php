<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\DroneCi\DroneCiService;

/**
 * Shared executor for Drone CI tools.
 *
 * Child tools define metadata and operation names while this class validates
 * required arguments, maps query/body data, and dispatches service calls.
 */
abstract class AbstractDroneCiTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  DroneCiService  $service  Drone API client.
     */
    public function __construct(protected DroneCiService $service) {}

    public function name(): string { return static::NAME; }

    public function description(): string { return static::DESCRIPTION; }

    public function parameters(): array { return static::PARAMETERS; }

    /**
     * Execute the Drone operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Drone CI integration is not configured.');
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
            'getCurrentUserFeed' => $this->service->getCurrentUserFeed($this->query($args)),
            'listCurrentUserRepos' => $this->service->listCurrentUserRepos($this->query($args)),
            'syncCurrentUser' => $this->service->syncCurrentUser(),
            'getRepo' => $this->service->getRepo((string) $args['owner'], (string) $args['repo']),
            'enableRepo' => $this->service->enableRepo((string) $args['owner'], (string) $args['repo']),
            'updateRepo' => $this->service->updateRepo((string) $args['owner'], (string) $args['repo'], $this->payload($args)),
            'disableRepo' => $this->service->disableRepo((string) $args['owner'], (string) $args['repo']),
            'repairRepo' => $this->service->repairRepo((string) $args['owner'], (string) $args['repo']),
            'chownRepo' => $this->service->chownRepo((string) $args['owner'], (string) $args['repo']),
            'listBuilds' => $this->service->listBuilds((string) $args['owner'], (string) $args['repo'], $this->query($args)),
            'createBuild' => $this->service->createBuild((string) $args['owner'], (string) $args['repo'], $this->query($args)),
            'getBuild' => $this->service->getBuild((string) $args['owner'], (string) $args['repo'], $args['build']),
            'restartBuild' => $this->service->restartBuild((string) $args['owner'], (string) $args['repo'], $args['build']),
            'stopBuild' => $this->service->stopBuild((string) $args['owner'], (string) $args['repo'], $args['build']),
            'approveBuild' => $this->service->approveBuild((string) $args['owner'], (string) $args['repo'], $args['build']),
            'declineBuild' => $this->service->declineBuild((string) $args['owner'], (string) $args['repo'], $args['build']),
            'promoteBuild' => $this->service->promoteBuild((string) $args['owner'], (string) $args['repo'], $args['build'], $this->query($args)),
            'getBuildLogs' => $this->service->getBuildLogs((string) $args['owner'], (string) $args['repo'], $args['build'], $args['stage'], $args['step']),
            'listCron' => $this->service->listCron((string) $args['owner'], (string) $args['repo']),
            'createCron' => $this->service->createCron((string) $args['owner'], (string) $args['repo'], $this->payload($args)),
            'getCron' => $this->service->getCron((string) $args['owner'], (string) $args['repo'], (string) $args['name']),
            'updateCron' => $this->service->updateCron((string) $args['owner'], (string) $args['repo'], (string) $args['name'], $this->payload($args)),
            'deleteCron' => $this->service->deleteCron((string) $args['owner'], (string) $args['repo'], (string) $args['name']),
            'triggerCron' => $this->service->triggerCron((string) $args['owner'], (string) $args['repo'], (string) $args['name']),
            'listSecrets' => $this->service->listSecrets((string) $args['owner'], (string) $args['repo']),
            'createSecret' => $this->service->createSecret((string) $args['owner'], (string) $args['repo'], $this->payload($args)),
            'getSecret' => $this->service->getSecret((string) $args['owner'], (string) $args['repo'], (string) $args['name']),
            'updateSecret' => $this->service->updateSecret((string) $args['owner'], (string) $args['repo'], (string) $args['name'], $this->payload($args)),
            'deleteSecret' => $this->service->deleteSecret((string) $args['owner'], (string) $args['repo'], (string) $args['name']),
            'listUsers' => $this->service->listUsers(),
            'getUser' => $this->service->getUser((string) $args['login']),
            'apiGet' => $this->service->apiGet((string) $args['path'], $this->query($args)),
            'apiPost' => $this->service->apiPost((string) $args['path'], $this->payload($args)),
            'apiPatch' => $this->service->apiPatch((string) $args['path'], $this->payload($args)),
            'apiDelete' => $this->service->apiDelete((string) $args['path'], $this->query($args)),
            default => throw new InvalidArgumentException('Unsupported Drone CI operation.'),
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
        foreach (['owner', 'repo', 'build', 'stage', 'step', 'name', 'login', 'path', 'query', 'payload'] as $key) {
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
        foreach (['owner', 'repo', 'build', 'stage', 'step', 'name', 'login', 'path', 'payload'] as $key) {
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
