<?php

namespace OpenCompany\IntegrationCore\Lua;

class LuaCatalogBuilder
{
    /**
     * Build normalized Lua namespaces from a host tool catalog.
     *
     * @param  array<int, array<string, mixed>>  $catalog
     * @param  array<int, string>  $skipApps
     * @return array<string, array{description: string, functions: array<int, array{name: string, description: string, fullDescription: string, parameters: array<int, array<string, mixed>>, sourceToolSlug: string}>}>
     */
    public function buildNamespaces(array $catalog, array $skipApps = ['tasks', 'system', 'lua']): array
    {
        $namespaces = [];

        foreach ($catalog as $app) {
            $appName = (string) ($app['name'] ?? '');

            if ($appName === '' || in_array($appName, $skipApps, true)) {
                continue;
            }

            $baseNamespace = ! empty($app['isIntegration'])
                ? "integrations.{$appName}"
                : $appName;

            foreach ($app['tools'] ?? [] as $tool) {
                $slug = (string) ($tool['slug'] ?? '');
                if ($slug === '') {
                    continue;
                }

                $namespaceName = $baseNamespace;
                if (str_starts_with($slug, 'mcp_')) {
                    $namespaceName = $this->mcpNamespace($slug);
                    $functionName = $this->mcpFunctionName($slug);
                } else {
                    $functionName = $this->deriveFunctionName(
                        (string) ($tool['name'] ?? $slug),
                        $appName,
                    );
                }

                if (! isset($namespaces[$namespaceName])) {
                    $namespaces[$namespaceName] = [
                        'description' => (string) ($app['description'] ?? ''),
                        'functions' => [],
                    ];
                }

                $namespaces[$namespaceName]['functions'][] = $this->buildFunction($functionName, $tool, $slug);
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
     * @param  array<string, array{description: string, functions: array<int, array{name: string, description: string, fullDescription: string, parameters: array<int, array<string, mixed>>, sourceToolSlug: string}>}>  $namespaces
     * @return array<string, string>
     */
    public function buildFunctionMap(array $namespaces): array
    {
        $map = [];

        foreach ($namespaces as $namespaceName => $namespace) {
            foreach ($namespace['functions'] as $function) {
                $map[$namespaceName . '.' . $function['name']] = $function['sourceToolSlug'];
            }
        }

        return $map;
    }

    /**
     * @param  array<string, array{description: string, functions: array<int, array{name: string, description: string, fullDescription: string, parameters: array<int, array<string, mixed>>, sourceToolSlug: string}>}>  $namespaces
     * @return array<string, list<string>>
     */
    public function buildParameterMap(array $namespaces): array
    {
        $map = [];

        foreach ($namespaces as $namespaceName => $namespace) {
            foreach ($namespace['functions'] as $function) {
                $map[$namespaceName . '.' . $function['name']] = array_map(
                    fn (array $param) => (string) ($param['name'] ?? ''),
                    $function['parameters'],
                );
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

        return implode('_', $filtered) ?: $snake;
    }

    /**
     * @param  array<string, mixed>  $tool
     * @return array{name: string, description: string, fullDescription: string, parameters: array<int, array<string, mixed>>, sourceToolSlug: string}
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
        ];
    }

    private function mcpNamespace(string $slug): string
    {
        if (preg_match('/^mcp_(.+?)__/', $slug, $matches) === 1) {
            return 'mcp.' . $matches[1];
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
