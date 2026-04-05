<?php

namespace OpenCompany\IntegrationCore\Lua;

use OpenCompany\IntegrationCore\Contracts\LuaToolInvoker;

class LuaBridge
{
    /** @var array<string, string> */
    private array $functionMap;

    /** @var array<string, list<string>> */
    private array $parameterMap;

    /** @var array<string, string>  Function path → account alias for multi-account integrations */
    private array $accountMap;

    /** @var list<array{path: string, durationMs: float, status: string, error?: string, icon?: string, name?: string, group?: string}> */
    private array $callLog = [];

    /**
     * @param  array<string, string>  $functionMap
     * @param  array<string, list<string>>  $parameterMap
     * @param  array<string, string>  $accountMap  Function path → account alias
     */
    public function __construct(
        array $functionMap,
        array $parameterMap,
        private LuaToolInvoker $invoker,
        array $accountMap = [],
    ) {
        $this->functionMap = $functionMap;
        $this->parameterMap = $parameterMap;
        $this->accountMap = $accountMap;
    }

    public function call(string $path, mixed ...$args): mixed
    {
        if (! isset($this->functionMap[$path])) {
            $message = "Unknown function: app.{$path}";

            $parts = explode('.', $path);
            if (count($parts) > 1) {
                $namespacePrefix = implode('.', array_slice($parts, 0, -1));
                $available = [];

                foreach ($this->functionMap as $functionPath => $_toolSlug) {
                    if (str_starts_with($functionPath, $namespacePrefix . '.')) {
                        $functionParts = explode('.', $functionPath);
                        $available[] = end($functionParts);
                    }
                }

                if ($available !== []) {
                    $message .= '. Did you mean: ' . implode(', ', $available);
                }
            }

            $this->callLog[] = [
                'path' => $path,
                'durationMs' => 0,
                'status' => 'error',
                'error' => $message,
                'group' => self::extractGroup($path),
            ];

            throw new \RuntimeException($message);
        }

        $toolSlug = $this->functionMap[$path];
        $toolMeta = $this->invoker->getToolMeta($toolSlug);
        $group = self::extractGroup($path);

        $params = [];
        if ($args !== [] && is_array($args[0])) {
            $params = $args[0];
        } elseif ($args !== []) {
            $params = $this->mapPositionalArgs($path, $args);
        }

        $start = microtime(true);

        $account = $this->accountMap[$path] ?? null;

        try {
            $result = $this->invoker->invoke($toolSlug, $params, $account);

            $this->callLog[] = [
                'path' => $path,
                'durationMs' => round((microtime(true) - $start) * 1000, 1),
                'status' => 'ok',
                'icon' => $toolMeta['icon'] ?? 'ph:wrench',
                'name' => $toolMeta['name'] ?? $toolSlug,
                'group' => $group,
            ];

            return $result;
        } catch (\Throwable $e) {
            $this->callLog[] = [
                'path' => $path,
                'durationMs' => round((microtime(true) - $start) * 1000, 1),
                'status' => 'error',
                'error' => $e->getMessage(),
                'icon' => $toolMeta['icon'] ?? 'ph:wrench',
                'name' => $toolMeta['name'] ?? $toolSlug,
                'group' => $group,
            ];

            throw $e;
        }
    }

    /**
     * @return list<array{path: string, durationMs: float, status: string, error?: string, icon?: string, name?: string, group?: string}>
     */
    public function getCallLog(): array
    {
        return $this->callLog;
    }

    private static function extractGroup(string $path): string
    {
        $parts = explode('.', $path);

        if (($parts[0] ?? null) === 'integrations' && isset($parts[1])) {
            return $parts[1];
        }

        return $parts[0] ?? '';
    }

    /**
     * @param  array<int, mixed>  $args
     * @return array<string, mixed>
     */
    private function mapPositionalArgs(string $path, array $args): array
    {
        $paramNames = $this->parameterMap[$path] ?? [];
        if ($paramNames === []) {
            return [];
        }

        $mapped = [];
        foreach ($args as $index => $value) {
            if (isset($paramNames[$index])) {
                $mapped[$paramNames[$index]] = $value;
            }
        }

        return $mapped;
    }
}
