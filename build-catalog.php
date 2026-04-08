#!/usr/bin/env php
<?php

/**
 * Build a JSON catalog of all integrations and their tools.
 *
 * Pure source-file parsing — never loads or evals any package code.
 * Parses ToolProvider and Tool PHP files with regex to extract metadata.
 *
 * Run from the repo root:
 *
 *   php build-catalog.php
 *
 * Outputs integrations-catalog.json in the current directory.
 */

$root = dirname(__FILE__);
$packagesDir = $root . '/packages';

// --- Source File Parser ---

/**
 * Extract the full body of a method from PHP source.
 *
 * Uses brace-counting to find the method body, respecting string literals
 * and heredoc/nowdoc blocks.
 */
function extractMethodBody(string $source, string $methodName): ?string
{
    $pattern = '/public\s+function\s+' . preg_quote($methodName, '/') . '\s*\([^)]*\)\s*(?::\s*[\w?\\\\]+\s*)?\{/';
    if (!preg_match($pattern, $source, $match, PREG_OFFSET_CAPTURE)) {
        return null;
    }

    $start = $match[0][1] + strlen($match[0][0]);
    $len = strlen($source);
    $depth = 1;
    $pos = $start;

    while ($pos < $len && $depth > 0) {
        $ch = $source[$pos];

        if ($ch === '{') {
            $depth++;
        } elseif ($ch === '}') {
            $depth--;
        } elseif ($ch === "'" || $ch === '"') {
            $quote = $ch;
            $pos++;
            while ($pos < $len && $source[$pos] !== $quote) {
                if ($source[$pos] === '\\') {
                    $pos++;
                }
                $pos++;
            }
        } elseif ($ch === '<' && substr($source, $pos, 3) === '<<<') {
            // Heredoc or nowdoc — skip to the end marker
            // Match <<<'MARKER' or <<<MARKER or <<<"MARKER"
            if (preg_match('/<<<' . "('?)(\\w+)\\1/", substr($source, $pos), $hm)) {
                $marker = $hm[2];
                // Skip to end of the opening line
                $pos = strpos($source, "\n", $pos) ?: $len;
                // Find the closing marker on its own line
                while ($pos < $len) {
                    $lineStart = $pos + 1;
                    $lineEnd = strpos($source, "\n", $lineStart) ?: $len;
                    $line = trim(substr($source, $lineStart, $lineEnd - $lineStart));
                    if ($line === $marker . ';' || $line === $marker) {
                        $pos = $lineEnd;
                        break;
                    }
                    $pos = $lineEnd;
                }
            }
        }

        $pos++;
    }

    return substr($source, $start, $pos - $start - 1);
}

/**
 * Extract the return array from a method body.
 *
 * Finds `return [...]` and extracts the array literal, resolving ::class
 * references using the file's use statements.
 *
 * @return array|null
 */
function extractReturnArray(string $source, string $methodName): ?array
{
    $body = extractMethodBody($source, $methodName);
    if ($body === null) {
        return null;
    }

    // Find `return [` position
    if (!preg_match('/return\s+\[/', $body, $m, PREG_OFFSET_CAPTURE)) {
        return null;
    }

    $arrayStart = $m[0][1] + strlen($m[0][0]) - 1; // include the '['
    $arraySrc = substr($body, $arrayStart);

    // Count brackets to find matching ]
    $depth = 0;
    $inString = false;
    $stringChar = '';
    $i = 0;
    $arrayLen = strlen($arraySrc);

    while ($i < $arrayLen) {
        $ch = $arraySrc[$i];
        if ($inString) {
            if ($ch === '\\' && $i + 1 < $arrayLen) {
                $i += 2;
                continue;
            }
            if ($ch === $stringChar) {
                $inString = false;
            }
        } else {
            if ($ch === "'" || $ch === '"') {
                $inString = true;
                $stringChar = $ch;
            } elseif ($ch === '[') {
                $depth++;
            } elseif ($ch === ']') {
                $depth--;
                if ($depth === 0) {
                    break;
                }
            }
        }
        $i++;
    }

    $arrayCode = substr($arraySrc, 0, $i + 1);

    // Build class map from use statements
    preg_match_all('/^use\s+([\w\\\\]+)\s*;/m', $source, $useMatches);
    $classMap = [];
    foreach ($useMatches[1] ?? [] as $fqcn) {
        $parts = explode('\\', $fqcn);
        $classMap[end($parts)] = $fqcn;
    }

    // Replace ShortName::class → 'FQCN' string literals
    $prepared = preg_replace_callback(
        '/(\w+)::class/',
        function ($m) use ($classMap) {
            if (isset($classMap[$m[1]])) {
                return "'" . addslashes($classMap[$m[1]]) . "'";
            }
            return 'null';
        },
        $arrayCode
    );

    // Note: we don't strip // comments because URLs like https:// contain //
    // The array code we extract is clean (no comments in metadata methods)

    try {
        $result = eval('return ' . $prepared . ';');
        return is_array($result) ? $result : null;
    } catch (Throwable $e) {
        return null;
    }
}

/**
 * Extract a method returning a string value (e.g., appName()).
 */
function extractReturnString(string $source, string $methodName): ?string
{
    $body = extractMethodBody($source, $methodName);
    if ($body === null) {
        return null;
    }

    if (preg_match("/return\s+'((?:[^'\\\\]|\\\\.)*)'\s*;/s", $body, $m)) {
        return stripcslashes($m[1]);
    }
    if (preg_match('/return\s+"((?:[^"\\\\]|\\\\.)*)"\s*;/s', $body, $m)) {
        return stripcslashes($m[1]);
    }

    return null;
}

/**
 * Check if a source file's class implements a given interface.
 */
function sourceImplements(string $source, string $interfaceShortName): bool
{
    return (bool) preg_match('/implements\s+[^{]*\b' . preg_quote($interfaceShortName, '/') . '\b/', $source);
}

/**
 * Derive FQCN from PHP source.
 */
function resolveFqcn(string $source): ?string
{
    if (!preg_match('/namespace\s+([\w\\\\]+)\s*;/', $source, $ns)) {
        return null;
    }
    if (!preg_match('/class\s+(\w+)\s+/', $source, $cls)) {
        return null;
    }
    return $ns[1] . '\\' . $cls[1];
}

// --- Helpers ---

/**
 * Infer auth type from credential fields.
 */
function inferAuthType(array $fields): string
{
    if (empty($fields)) {
        return 'none';
    }

    // Normalize flat format ['token' => 'Label'] to [['key' => 'token', ...]]
    $normalized = [];
    foreach ($fields as $k => $v) {
        if (is_array($v) && isset($v['key'])) {
            $normalized[] = $v;
        } elseif (is_string($v)) {
            $normalized[] = ['key' => (string) $k, 'type' => 'secret'];
        }
    }

    $keys = array_map('strtolower', array_column($normalized, 'key'));
    $types = array_column($normalized, 'type');

    if (in_array('oauth_connect', $types)) {
        return 'oauth';
    }
    if (in_array('access_token', $keys) || in_array('refresh_token', $keys)) {
        return 'oauth';
    }

    foreach ($keys as $key) {
        if (str_contains($key, 'token') || str_contains($key, 'api_token')) {
            return 'api_token';
        }
    }

    return 'api_key';
}

function readComposerJson(string $pkgDir): array
{
    $path = $pkgDir . '/composer.json';
    if (!file_exists($path)) {
        return [];
    }
    $data = json_decode(file_get_contents($path), true);
    return is_array($data) ? [
        'description' => $data['description'] ?? null,
        'keywords' => $data['keywords'] ?? [],
    ] : [];
}

function readLuaDocs(string $pkgDir): string
{
    $luaDir = $pkgDir . '/lua-docs';
    if (!is_dir($luaDir)) {
        return '';
    }
    $files = glob($luaDir . '/*.md');
    if (empty($files)) {
        return '';
    }
    $parts = [];
    foreach ($files as $file) {
        $content = trim(file_get_contents($file));
        if ($content !== '') {
            $parts[] = $content;
        }
    }
    return implode("\n\n---\n\n", $parts);
}

function packageSlug(string $filePath): string
{
    if (preg_match('#packages/([^/]+)/src/#', $filePath, $m)) {
        return $m[1];
    }
    return '';
}

// --- Main ---

$providerFiles = glob($packagesDir . '/*/src/*ToolProvider.php');
sort($providerFiles);

if (empty($providerFiles)) {
    fwrite(STDERR, "No ToolProvider files found in packages/\n");
    exit(1);
}

$integrations = [];
$totalTools = 0;
$errors = [];

foreach ($providerFiles as $providerFile) {
    $source = file_get_contents($providerFile);

    $appName = extractReturnString($source, 'appName');
    if ($appName === null) {
        $errors[] = "appName: {$providerFile}";
        continue;
    }

    $pkgSlug = packageSlug($providerFile);
    $pkgDir = dirname($providerFile, 2);

    $appMeta = extractReturnArray($source, 'appMeta') ?? [];
    $toolDefs = extractReturnArray($source, 'tools') ?? [];
    $credFields = extractReturnArray($source, 'credentialFields') ?? [];

    $integrationMeta = null;
    if (sourceImplements($source, 'ConfigurableIntegration')) {
        $integrationMeta = extractReturnArray($source, 'integrationMeta');
    }

    $triggerDefs = [];
    if (sourceImplements($source, 'HasTriggers')) {
        $triggerDefs = extractReturnArray($source, 'triggers') ?? [];
    }

    $composer = readComposerJson($pkgDir);
    $luaDocs = readLuaDocs($pkgDir);

    // --- Tool-level data ---

    $tools = [];
    foreach ($toolDefs as $toolSlug => $toolMeta) {
        $toolClass = $toolMeta['class'] ?? null;
        if ($toolClass === null) {
            continue;
        }

        // Derive tool file path from FQCN
        $toolShortName = basename(str_replace('\\', '/', $toolClass));
        $toolFile = $pkgDir . '/src/Tools/' . $toolShortName . '.php';

        $toolDescription = '';
        $toolParameters = [];

        if (file_exists($toolFile)) {
            $toolSource = file_get_contents($toolFile);

            // Extract description using extractMethodBody (handles heredocs)
            $descBody = extractMethodBody($toolSource, 'description');
            if ($descBody !== null) {
                // Handle heredoc/nowdoc
                if (preg_match("/return\s+<<<'(\w+)'.*?^\s*\\1\s*;?\s*$/ms", $descBody, $m)) {
                    // Nowdoc
                    $content = $m[0];
                    $content = preg_replace("/^return\s+<<<'\w+'\s*\n?/s", '', $content);
                    $content = preg_replace("/\s*\w+\s*;\s*$/s", '', $content);
                    $toolDescription = trim($content);
                } elseif (preg_match("/return\s+<<<(\w+).*?^\s*\\1\s*;?\s*$/ms", $descBody, $m)) {
                    // Heredoc
                    $content = $m[0];
                    $content = preg_replace("/^return\s+<<<\w+\s*\n?/s", '', $content);
                    $content = preg_replace("/\s*\w+\s*;\s*$/s", '', $content);
                    $toolDescription = trim(stripcslashes($content));
                } elseif (preg_match("/return\s+'((?:[^'\\\\]|\\\\.)*)'\s*;/s", $descBody, $m)) {
                    $toolDescription = stripcslashes($m[1]);
                } elseif (preg_match('/return\s+"((?:[^"\\\\]|\\\\.)*)"\s*;/s', $descBody, $m)) {
                    $toolDescription = stripcslashes($m[1]);
                }
            }

            // Extract parameters
            $params = extractReturnArray($toolSource, 'parameters');
            if ($params !== null) {
                $toolParameters = $params;
            }
        }

        $tools[] = [
            'slug' => $toolSlug,
            'name' => $toolMeta['name'] ?? '',
            'type' => $toolMeta['type'] ?? 'read',
            'icon' => $toolMeta['icon'] ?? '',
            'short_description' => $toolMeta['description'] ?? '',
            'description' => $toolDescription,
            'parameters' => $toolParameters,
        ];
        $totalTools++;
    }

    // --- Triggers ---

    $triggers = [];
    foreach ($triggerDefs as $triggerSlug => $triggerMeta) {
        $triggers[] = [
            'slug' => $triggerSlug,
            'name' => $triggerMeta['name'] ?? '',
            'description' => $triggerMeta['description'] ?? '',
            'icon' => $triggerMeta['icon'] ?? '',
        ];
    }

    // --- Credentials ---

    $credentials = [];
    foreach ($credFields as $field) {
        if (is_array($field) && isset($field['key'])) {
            $credentials[] = [
                'key' => $field['key'] ?? '',
                'type' => $field['type'] ?? 'string',
                'label' => $field['label'] ?? '',
                'required' => $field['required'] ?? false,
            ];
        }
    }
    // Handle flat key=>value format (e.g., vercel: ['token' => 'Vercel API Token'])
    if (empty($credentials)) {
        foreach ($credFields as $key => $value) {
            if (is_string($value)) {
                $credentials[] = [
                    'key' => (string) $key,
                    'type' => 'secret',
                    'label' => $value,
                    'required' => true,
                ];
            }
        }
    }

    // --- Assemble ---

    $integrations[] = [
        'slug' => $appName,
        'package' => $pkgSlug,
        'name' => $integrationMeta['name'] ?? ucfirst(str_replace(['-', '_'], ' ', $appName)),
        'description' => $integrationMeta['description'] ?? $appMeta['description'] ?? '',
        'short_description' => $appMeta['description'] ?? '',
        'label' => $appMeta['label'] ?? '',
        'category' => $integrationMeta['category'] ?? 'other',
        'badge' => $integrationMeta['badge'] ?? null,
        'icon' => $integrationMeta['icon'] ?? $appMeta['icon'] ?? '',
        'logo' => $integrationMeta['logo'] ?? $appMeta['logo'] ?? '',
        'docs_url' => $integrationMeta['docs_url'] ?? null,
        'auth_type' => inferAuthType($credFields),
        'keywords' => $composer['keywords'] ?? [],
        'composer_description' => $composer['description'] ?? null,
        'has_triggers' => !empty($triggerDefs),
        'tools' => $tools,
        'triggers' => $triggers,
        'credentials' => $credentials,
        'lua_docs' => $luaDocs !== '' ? $luaDocs : null,
    ];
}

// --- Output ---

$catalog = [
    'generated_at' => date('c'),
    'total_integrations' => count($integrations),
    'total_tools' => $totalTools,
    'integrations' => $integrations,
];

$json = json_encode($catalog, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

if ($json === false) {
    fwrite(STDERR, "JSON encode failed: " . json_last_error_msg() . "\n");
    exit(1);
}

$outputPath = $root . '/integrations-catalog.json';
file_put_contents($outputPath, $json . "\n");

echo "Written {$outputPath}\n";
echo "  Integrations: " . count($integrations) . "\n";
echo "  Tools:        {$totalTools}\n";

if (!empty($errors)) {
    echo "\nWarnings (" . count($errors) . "):\n";
    foreach (array_slice($errors, 0, 30) as $error) {
        echo "  - {$error}\n";
    }
    if (count($errors) > 30) {
        echo "  ... and " . (count($errors) - 30) . " more\n";
    }
}
