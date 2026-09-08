<?php

declare(strict_types=1);

/**
 * Export source-owned provider metadata for documentation conformance. This
 * never creates tools, resolves credentials, tests connections or invokes APIs.
 * Pass a host Composer autoloader for framework interfaces only; package source
 * in this checkout takes precedence over any installed integration mirrors.
 */
$root = dirname(__DIR__);
require $argv[1];
$providerFiles = glob($root.'/packages/*/src/*ToolProvider.php');
$selectedFile = $argv[2] ?? null;
if ($selectedFile !== null && !in_array($selectedFile, $providerFiles, true)) {
    throw new RuntimeException('Selected provider is outside the source inventory.');
}
$prefixes = ['OpenCompany\\IntegrationCore\\' => $root.'/core/src/'];
foreach (glob($root.'/packages/*/composer.json') as $manifest) {
    $composer = json_decode(file_get_contents($manifest), true, 512, JSON_THROW_ON_ERROR);
    foreach ($composer['autoload']['psr-4'] ?? [] as $prefix => $directory) {
        $prefixes[$prefix] = dirname($manifest).'/'.$directory;
    }
}
// Some historical packages reuse the canonical package's PHP namespace. They
// cannot coexist in one PHP process. A scoped child reads each such provider
// independently; never silently export whichever class Composer loaded first.
if ($selectedFile !== null) {
    $packageRoot = dirname($selectedFile, 2);
    $composer = json_decode(file_get_contents($packageRoot.'/composer.json'), true, 512, JSON_THROW_ON_ERROR);
    foreach ($composer['autoload']['psr-4'] ?? [] as $prefix => $directory) {
        $prefixes[$prefix] = $packageRoot.'/'.$directory;
    }
}
spl_autoload_register(static function (string $class) use ($prefixes): void {
    foreach ($prefixes as $prefix => $directory) {
        if (str_starts_with($class, $prefix)) {
            $file = $directory.str_replace('\\', '/', substr($class, strlen($prefix))).'.php';
            if (is_file($file)) require_once $file;
            return;
        }
    }
}, prepend: true);
$catalog = [];
$retiredAliases = [];
$publishedTools = [];
foreach (json_decode(file_get_contents($root.'/catalog/resources/integrations-catalog.json'), true, 512, JSON_THROW_ON_ERROR)['integrations'] as $integration) {
    foreach ($integration['tools'] as $tool) $publishedTools[$tool['slug']] = $tool;
}
$providerClasses = [];
foreach ($providerFiles as $file) {
    preg_match('/namespace ([^;]+);/', file_get_contents($file), $namespace);
    $providerClasses[$file] = $namespace[1].'\\'.basename($file, '.php');
}
$classCounts = array_count_values(array_map('strtolower', $providerClasses));
foreach ($selectedFile !== null ? [$selectedFile] : $providerFiles as $file) {
    $class = $providerClasses[$file];
    $source = file_get_contents($file);
    $manifest = json_decode(file_get_contents(dirname($file, 2).'/composer.json'), true, 512, JSON_THROW_ON_ERROR);
    if (preg_match('/class\s+\w+\s+extends\s+\\\\?([\\\\\w]+)/', $source, $parent)
        && strcasecmp($class, $parent[1]) === 0) {
        // PHP class identity is case-insensitive. A retired case-only wrapper
        // cannot be loaded as a second class. Record the declared replacement
        // instead of inventing a second executable capability namespace.
        if (!is_string($manifest['abandoned'] ?? null)) {
            throw new RuntimeException('Case-only provider inheritance without a declared replacement.');
        }
        $retiredAliases[] = ['package' => basename(dirname($file, 2)), 'replacement' => $manifest['abandoned']];
        continue;
    }
    if ($selectedFile === null && $classCounts[strtolower($class)] > 1) {
        $process = proc_open([PHP_BINARY, __FILE__, $argv[1], $file],
            [0 => ['file', '/dev/null', 'r'], 1 => ['pipe', 'w'], 2 => STDERR], $pipes);
        if (!is_resource($process)) throw new RuntimeException('Provider metadata subprocess failed to start.');
        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        if (proc_close($process) !== 0) throw new RuntimeException('Provider metadata subprocess failed.');
        array_push($catalog, ...json_decode($output, true, 512, JSON_THROW_ON_ERROR)['integrations']);
        continue;
    }
    require_once $file;
    $reflection = new ReflectionClass($class);
    if (realpath($reflection->getFileName()) !== realpath($file)) {
        throw new RuntimeException('Provider metadata resolved to a different source package.');
    }
    $provider = $reflection->newInstanceWithoutConstructor();
    $builder = new OpenCompany\IntegrationCore\Script\ScriptCatalogBuilder;
    $tools = [];
    foreach ($provider->tools() as $slug => $tool) {
        if (is_string($tool)) $tool = ['class' => $tool];
        $name = $tool['name'] ?? $publishedTools[$slug]['name'] ?? Illuminate\Support\Str::headline(str_replace('_', ' ', $slug));
        $tools[] = ['slug' => $slug, 'name' => $name,
            'function_name' => $builder->deriveFunctionName($name, $provider->appName()),
            'type' => $tool['type'] ?? $publishedTools[$slug]['type'] ?? 'action'];
    }
    $names = $builder->functionNames($tools, $provider->appName());
    foreach ($tools as &$tool) $tool['function_name'] = $names[$tool['slug']];
    unset($tool);
    $catalog[] = ['package' => basename(dirname($file, 2)), 'slug' => $provider->appName(), 'tools' => $tools];
}
echo json_encode(['integrations' => $catalog, 'retired_aliases' => $retiredAliases], JSON_THROW_ON_ERROR);
