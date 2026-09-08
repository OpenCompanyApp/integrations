<?php

declare(strict_types=1);

/**
 * Verify the source-owned Script catalog before Ruby documentation is compiled.
 *
 * The exporter is intentionally the authority for provider discovery: it loads
 * package source from this checkout ahead of the host's installed packages and
 * never constructs a service, resolves a credential, or invokes an API. This
 * check then rebuilds every public, exact, and account-qualified path through
 * the shared core to catch alias collisions or metadata that would broaden a
 * script's authority.
 *
 * Usage: php scripts/check-mruby-contracts.php /absolute/path/to/host/autoload.php
 */
if ($argc !== 2 || ! is_file($argv[1])) {
    fwrite(STDERR, "Usage: php scripts/check-mruby-contracts.php /absolute/path/to/host/autoload.php\n");
    exit(64);
}

$root = dirname(__DIR__);
$autoload = realpath($argv[1]);
if ($autoload === false) {
    throw new RuntimeException('The host autoloader path could not be resolved.');
}

/**
 * @return array{integrations: list<array{package: string, slug: string, tools: list<array{slug: string, name: string, function_name: string, type: string}>}>, retired_aliases: list<array{package: string, replacement: string}>}
 */
function exportSourceCatalog(string $root, string $autoload): array
{
    $process = proc_open(
        [PHP_BINARY, $root.'/scripts/export-script-catalog.php', $autoload],
        [0 => ['file', '/dev/null', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
        $pipes,
        $root,
    );

    if (! is_resource($process)) {
        throw new RuntimeException('The source catalog exporter could not be started.');
    }

    $output = stream_get_contents($pipes[1]);
    $errors = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);

    if (proc_close($process) !== 0) {
        throw new RuntimeException('The source catalog exporter failed: '.trim($errors));
    }

    /** @var array{integrations: list<array{package: string, slug: string, tools: list<array{slug: string, name: string, function_name: string, type: string}>}>, retired_aliases: list<array{package: string, replacement: string}>} $catalog */
    $catalog = json_decode($output, true, 512, JSON_THROW_ON_ERROR);

    return $catalog;
}

require $autoload;

$export = exportSourceCatalog($root, $autoload);
$contracts = [];

foreach ($export['integrations'] as $integration) {
    $slug = $integration['slug'];
    if ($slug === '') {
        throw new RuntimeException('A source package exported an empty integration slug.');
    }

    $tools = [];
    $sourceTools = [];
    foreach ($integration['tools'] as $tool) {
        if ($tool['slug'] === '') {
            throw new RuntimeException("{$integration['package']} exported an empty tool slug.");
        }

        // These sentinels protect the core's transport contract even though
        // provider discovery intentionally exposes no host-specific schema or
        // account configuration. Exact aliases must retain both unchanged.
        $tools[] = [
            'slug' => $tool['slug'],
            'name' => $tool['name'],
            'type' => $tool['type'],
            'parameters' => [['name' => 'sourceToken', 'type' => 'string', 'required' => true]],
        ];
        $sourceTools[$tool['slug']] = true;
    }

    $catalog = [[
        'name' => $slug,
        'isIntegration' => true,
        'accounts' => ['source_account'],
        'tools' => $tools,
    ]];

    $builder = new OpenCompany\IntegrationCore\Script\ScriptCatalogBuilder;
    $namespaces = $builder->buildNamespaces($catalog);
    $functions = $builder->buildFunctionMap($namespaces);
    $parameters = $builder->buildParameterMap($namespaces);
    $accounts = $builder->buildAccountMap($namespaces);

    foreach ($functions as $path => $sourceToolSlug) {
        if (! isset($sourceTools[$sourceToolSlug])) {
            throw new RuntimeException("Script path {$path} targets a tool that {$integration['package']} did not publish.");
        }
    }

    foreach ($tools as $tool) {
        $exact = 'integrations.'.$slug.'.'.$tool['slug'];
        $accountExact = 'integrations.'.$slug.'.source_account.'.$tool['slug'];
        if (($functions[$exact] ?? null) !== $tool['slug'] || ($functions[$accountExact] ?? null) !== $tool['slug']) {
            throw new RuntimeException("Exact aliases for {$exact} no longer target their published source tool.");
        }
        if (($parameters[$exact][0]['name'] ?? null) !== 'source_token'
            || ($parameters[$accountExact][0]['name'] ?? null) !== 'source_token'
            || ($accounts[$accountExact] ?? null) !== 'source_account') {
            throw new RuntimeException("Exact aliases for {$exact} no longer preserve parameters and account selection.");
        }
    }

    $contracts[$integration['package']] = [
        'functions' => count($functions),
        'parameters' => count($parameters),
        'accounts' => count($accounts),
    ];
}

$toolCount = array_sum(array_map(static fn (array $integration): int => count($integration['tools']), $export['integrations']));
$summary = [
    'source_packages' => count($export['integrations']),
    'source_tools' => $toolCount,
    'published_function_paths' => array_sum(array_column($contracts, 'functions')),
    'parameter_paths' => array_sum(array_column($contracts, 'parameters')),
    'account_qualified_paths' => array_sum(array_column($contracts, 'accounts')),
    'retired_aliases' => count($export['retired_aliases']),
];

// Report actual counts rather than treating a large source catalog as a fixed
// ceiling. A change that adds tools must be reviewed, not silently truncated.
echo json_encode($summary, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT).PHP_EOL;
