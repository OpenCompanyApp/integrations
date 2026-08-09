<?php

namespace OpenCompany\IntegrationCore\Script;

/**
 * Builds stable app.* namespaces and argument maps from host tool catalogs.
 *
 * This component is language-neutral. Hosts may expose the resulting catalog
 * through any synchronous script runtime without moving authorization or tool
 * execution into the package layer.
 */
class ScriptCatalogBuilder
{
    /**
     * Build normalized Code Mode namespaces from a host tool catalog.
     *
     * @param  array<int, array<string, mixed>>  $catalog
     * @param  array<int, string>  $skipApps
     * @return array<string, array{description: string, functions: list<array{name: string, description: string, fullDescription: string, parameters: list<array<string, mixed>>, sourceToolSlug: string, effect: string, returns: array<string, mixed>}>, account?: string}>
     */
    public function buildNamespaces(array $catalog, array $skipApps = ['tasks', 'system', 'code']): array
    {
        $namespaces = [];

        foreach ($catalog as $app) {
            $appName = (string) ($app['name'] ?? '');

            if ($appName === '' || in_array($appName, $skipApps, true)) {
                continue;
            }

            $isIntegration = ! empty($app['isIntegration']);
            $baseNamespace = $isIntegration
                ? "integrations.{$appName}"
                : $appName;

            $description = (string) ($app['description'] ?? '');
            $accounts = $app['accounts'] ?? [];
            $functions = [];
            $mcpNamespaceFunctions = []; // mcpNamespace => [functions]

            foreach ($app['tools'] ?? [] as $tool) {
                $slug = (string) ($tool['slug'] ?? '');
                if ($slug === '') {
                    continue;
                }

                if (str_starts_with($slug, 'mcp_')) {
                    $ns = $this->mcpNamespace($slug);
                    $fn = $this->mcpFunctionName($slug);
                    $mcpNamespaceFunctions[$ns][] = $this->buildFunction($fn, $tool, $slug);

                    continue;
                }

                $functionName = $this->deriveFunctionName(
                    (string) ($tool['name'] ?? $slug),
                    $appName,
                );

                $functions[] = $this->buildFunction($functionName, $tool, $slug);
            }

            // Handle MCP tool namespaces
            foreach ($mcpNamespaceFunctions as $mcpNs => $mcpFns) {
                // Flat namespace (default)
                $namespaces[$mcpNs] = [
                    'description' => $description,
                    'functions' => $mcpFns,
                ];

                // Explicit "default" alias — portable across users
                $namespaces[$mcpNs.'.default'] = [
                    'description' => $description,
                    'functions' => $mcpFns,
                ];

                // Per-account sub-namespaces
                foreach ($accounts as $account) {
                    $namespaces[$mcpNs.'.'.$account] = [
                        'description' => $description,
                        'functions' => $mcpFns,
                        'account' => $account,
                    ];
                }
            }

            // Handle regular (non-MCP) tool namespaces
            if ($functions !== []) {
                // Flat namespace (default)
                $namespaces[$baseNamespace] = [
                    'description' => $description,
                    'functions' => $functions,
                ];

                // For integrations: add "default" alias and per-account sub-namespaces
                if ($isIntegration) {
                    $namespaces[$baseNamespace.'.default'] = [
                        'description' => $description,
                        'functions' => $functions,
                    ];

                    foreach ($accounts as $account) {
                        $namespaces[$baseNamespace.'.'.$account] = [
                            'description' => $description,
                            'functions' => $functions,
                            'account' => $account,
                        ];
                    }
                }
            }
        }

        uksort($namespaces, function (string $a, string $b): int {
            $aWeight = str_starts_with($a, 'mcp.') ? 2 : (str_starts_with($a, 'integrations.') ? 1 : 0);
            $bWeight = str_starts_with($b, 'mcp.') ? 2 : (str_starts_with($b, 'integrations.') ? 1 : 0);

            return $aWeight <=> $bWeight ?: strcmp($a, $b);
        });

        return $namespaces;
    }

    /**
     * @param  array<string, array{description: string, functions: list<array{name: string, description: string, fullDescription: string, parameters: list<array<string, mixed>>, sourceToolSlug: string, effect: string, returns: array<string, mixed>}>, account?: string}>  $namespaces
     * @return array<string, string>
     */
    public function buildFunctionMap(array $namespaces): array
    {
        $map = [];

        foreach ($namespaces as $namespaceName => $namespace) {
            foreach ($namespace['functions'] as $function) {
                $map[$namespaceName.'.'.$function['name']] = $function['sourceToolSlug'];
            }
        }

        return $map;
    }

    /**
     * @param  array<string, array{description: string, functions: list<array{name: string, description: string, fullDescription: string, parameters: list<array<string, mixed>>, sourceToolSlug: string, effect: string, returns: array<string, mixed>}>, account?: string}>  $namespaces
     * @return array<string, list<array<string, mixed>>>
     */
    public function buildParameterMap(array $namespaces): array
    {
        $map = [];

        foreach ($namespaces as $namespaceName => $namespace) {
            foreach ($namespace['functions'] as $function) {
                $map[$namespaceName.'.'.$function['name']] = $function['parameters'];
            }
        }

        return $map;
    }

    /**
     * Build a map of function paths to account aliases for multi-account integrations.
     *
     * Paths without an account (flat/default namespace) are NOT included — they
     * resolve to null in the bridge, which means "use the default account".
     *
     * @param  array<string, array{description: string, functions: array, account?: string}>  $namespaces
     * @return array<string, string> Function path → account alias
     */
    public function buildAccountMap(array $namespaces): array
    {
        $map = [];

        foreach ($namespaces as $namespaceName => $namespace) {
            $account = $namespace['account'] ?? null;
            if ($account === null) {
                continue;
            }

            foreach ($namespace['functions'] as $function) {
                $map[$namespaceName.'.'.$function['name']] = $account;
            }
        }

        return $map;
    }

    public function deriveFunctionName(string $toolName, string $appName): string
    {
        $snake = strtolower(trim($toolName));
        $snake = preg_replace('/[^a-z0-9]+/', '_', $snake) ?? '';
        $snake = trim($snake, '_');

        if ($snake === '') {
            return 'tool';
        }

        $words = explode('_', $snake);
        $appBase = rtrim(strtolower($appName), 's');

        $filtered = array_values(array_filter($words, function (string $word) use ($appBase): bool {
            if (in_array($word, ['on', 'of', 'for', 'in', 'to', 'the', 'a', 'an'], true)) {
                return false;
            }

            $wordBase = rtrim($word, 's');

            return ! str_contains($wordBase, $appBase) && ! str_contains($appBase, $wordBase);
        }));

        $name = implode('_', $filtered) ?: $snake;

        return preg_match('/^[0-9]/', $name) === 1 ? "_{$name}" : $name;
    }

    /**
     * @param  array<string, mixed>  $tool
     * @return array{name: string, description: string, fullDescription: string, parameters: list<array<string, mixed>>, sourceToolSlug: string, effect: string, returns: array<string, mixed>}
     */
    private function buildFunction(string $functionName, array $tool, string $slug): array
    {
        $parameters = [];

        foreach ($tool['parameters'] ?? [] as $parameter) {
            if (! is_array($parameter)) {
                continue;
            }

            $name = (string) ($parameter['name'] ?? '');
            if ($name === '') {
                continue;
            }

            $parameter['name'] = $this->toSnakeCase($name);
            $parameters[] = $parameter;
        }

        return [
            'name' => $functionName,
            'description' => (string) ($tool['fullDescription'] ?? $tool['description'] ?? ''),
            'fullDescription' => (string) ($tool['fullDescription'] ?? ''),
            'parameters' => $parameters,
            'sourceToolSlug' => $slug,
            'effect' => (string) ($tool['type'] ?? 'read'),
            'returns' => is_array($tool['returns'] ?? null) ? $tool['returns'] : [],
        ];
    }

    private function mcpNamespace(string $slug): string
    {
        if (preg_match('/^mcp_(.+?)__/', $slug, $matches) === 1) {
            return 'mcp.'.$matches[1];
        }

        return 'mcp';
    }

    private function mcpFunctionName(string $slug): string
    {
        if (preg_match('/^mcp_.+?__(.+)$/', $slug, $matches) === 1) {
            return preg_replace('/[^a-z0-9]+/', '_', strtolower($matches[1])) ?? 'tool';
        }

        return preg_replace('/[^a-z0-9]+/', '_', strtolower($slug)) ?? 'tool';
    }

    private function toSnakeCase(string $name): string
    {
        return strtolower((string) preg_replace('/[A-Z]/', '_$0', $name));
    }
}
