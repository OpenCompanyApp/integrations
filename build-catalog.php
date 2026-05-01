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

    $prepared = replaceSchemaBuilderCalls($prepared);
    $prepared = escapeDoubleQuotedStringVariables($prepared);

    // Note: we don't strip // comments because URLs like https:// contain //
    // The array code we extract is clean (no comments in metadata methods)

    try {
        set_error_handler(function (int $severity, string $message, string $file, int $line): never {
            throw new ErrorException($message, 0, $severity, $file, $line);
        });
        $result = eval('return ' . $prepared . ';');
        return is_array($result) ? $result : null;
    } catch (Throwable $e) {
        return null;
    } finally {
        restore_error_handler();
    }
}

/**
 * Keep dollar signs inside double-quoted metadata strings literal during eval.
 */
function escapeDoubleQuotedStringVariables(string $code): string
{
    $out = '';
    $len = strlen($code);
    $quote = null;

    for ($i = 0; $i < $len; $i++) {
        $ch = $code[$i];

        if ($quote === null) {
            if ($ch === "'" || $ch === '"') {
                $quote = $ch;
            }
            $out .= $ch;
            continue;
        }

        if ($ch === '\\' && $i + 1 < $len) {
            $out .= $ch . $code[$i + 1];
            $i++;
            continue;
        }

        if ($ch === $quote) {
            $quote = null;
            $out .= $ch;
            continue;
        }

        $out .= $quote === '"' && $ch === '$' ? '\\$' : $ch;
    }

    return $out;
}

/**
 * Convert simple schema-builder calls used in metadata arrays into literals.
 */
function replaceSchemaBuilderCalls(string $code): string
{
    return preg_replace_callback(
        '/\$schema\s*->\s*(string|integer|number|boolean|array|object)\s*\(\s*\)\s*(?:->\s*description\s*\(\s*((?:\'(?:[^\'\\\\]|\\\\.)*\'|"(?:[^"\\\\]|\\\\.)*"))\s*\))?/s',
        static function (array $m): string {
            $type = $m[1];
            $description = $m[2] ?? null;

            $items = ["'type' => '{$type}'"];
            if ($description !== null) {
                $items[] = "'description' => {$description}";
            }

            return '[' . implode(', ', $items) . ']';
        },
        $code,
    ) ?? $code;
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

/**
 * Extract imported tool classes when a provider has no explicit tools() map.
 *
 * @return list<string>
 */
function extractImportedToolClasses(string $source): array
{
    preg_match_all('/^use\s+([\w\\\\]+\\\\Tools\\\\\w+)\s*;/m', $source, $matches);

    return array_values(array_unique($matches[1] ?? []));
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
    if (!is_array($data)) {
        return [];
    }

    $providers = $data['extra']['laravel']['providers'] ?? [];
    $psr4 = $data['autoload']['psr-4'] ?? [];

    return [
        'name' => $data['name'] ?? null,
        'description' => $data['description'] ?? null,
        'keywords' => $data['keywords'] ?? [],
        'license' => $data['license'] ?? null,
        'authors' => $data['authors'] ?? [],
        'type' => $data['type'] ?? null,
        'require' => $data['require'] ?? [],
        'replace' => $data['replace'] ?? [],
        'providers' => is_array($providers) ? array_values($providers) : [],
        'namespace' => is_array($psr4) && !empty($psr4) ? array_key_first($psr4) : null,
    ];
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

function readReadme(string $pkgDir): array
{
    $path = $pkgDir . '/README.md';
    if (!file_exists($path)) {
        return [
            'exists' => false,
            'title' => null,
            'excerpt' => null,
        ];
    }

    $content = trim(file_get_contents($path));
    $title = null;
    if (preg_match('/^#\s+(.+)$/m', $content, $m)) {
        $title = trim($m[1]);
    }

    $excerpt = null;
    $blocks = preg_split('/\n\s*\n/', $content) ?: [];
    foreach ($blocks as $block) {
        $block = trim($block);
        if ($block === '' || str_starts_with($block, '#') || str_starts_with($block, '```')) {
            continue;
        }
        $block = preg_replace('/^>\s?/m', '', $block);
        $excerpt = truncateText(cleanText($block), 320);
        break;
    }

    return [
        'exists' => true,
        'title' => $title,
        'excerpt' => $excerpt,
    ];
}

function packageSlug(string $filePath): string
{
    if (preg_match('#packages/([^/]+)/src/#', $filePath, $m)) {
        return $m[1];
    }
    return '';
}

function cleanText(?string $text): string
{
    $text = (string) $text;
    $text = strip_tags($text);
    $text = preg_replace('/[`*_#>\[\]\(\)]/', '', $text) ?? $text;
    $text = preg_replace('/\s+/', ' ', $text) ?? $text;

    return trim($text);
}

function truncateText(string $text, int $maxLength): string
{
    $text = cleanText($text);
    if (strlen($text) <= $maxLength) {
        return $text;
    }

    $cut = substr($text, 0, $maxLength - 1);
    $space = strrpos($cut, ' ');
    if ($space !== false && $space > 80) {
        $cut = substr($cut, 0, $space);
    }

    return rtrim($cut, " \t\n\r\0\x0B.,;:") . '…';
}

function envVarName(string $slug, string $key): string
{
    $base = strtoupper(preg_replace('/[^A-Za-z0-9]+/', '_', $slug) ?? $slug);
    $field = strtoupper(preg_replace('/[^A-Za-z0-9]+/', '_', $key) ?? $key);

    return trim($base . '_' . $field, '_');
}

function buildHeadlessSetupMetadata(string $slug, string $displayName, array $credentials, array $capabilities): array
{
    $setupFlags = [];
    foreach ($credentials as $field) {
        if (!is_array($field)) {
            continue;
        }

        $key = (string) ($field['key'] ?? '');
        if ($key === '') {
            continue;
        }

        $setupFlags[] = [
            'key' => $key,
            'flag' => '--set ' . $key . '="$' . envVarName($slug, $key) . '"',
            'env' => envVarName($slug, $key),
            'required' => (bool) ($field['required'] ?? true),
        ];
    }

    $configureCommand = 'kosmokrator integrations:configure ' . $slug;
    foreach ($setupFlags as $flag) {
        if ($flag['required']) {
            $configureCommand .= ' ' . $flag['flag'];
        }
    }
    $configureCommand .= ' --enable --read allow --write ask --json';

    $cliSetupSupported = (bool) ($capabilities['compatibility']['cli_setup_supported'] ?? false);
    $cliRuntimeSupported = (bool) ($capabilities['compatibility']['cli_runtime_supported'] ?? false);

    return [
        'required_credentials' => array_values(array_map(
            static fn (array $flag): string => $flag['key'],
            array_filter($setupFlags, static fn (array $flag): bool => $flag['required']),
        )),
        'env_vars' => array_column($setupFlags, 'env'),
        'cli_configure_command' => $configureCommand,
        'doctor_command' => 'kosmokrator integrations:doctor ' . $slug . ' --json',
        'status_command' => 'kosmokrator integrations:status --json',
        'mcp_gateway_install_command' => 'kosmokrator mcp:gateway:install --integration=' . $slug . ' --write=deny --json',
        'mcp_gateway_serve_command' => 'kosmokrator mcp:serve --integration=' . $slug . ' --write=deny',
        'cli_setup_summary' => $cliSetupSupported
            ? $displayName . ' can be configured headlessly with `kosmokrator integrations:configure ' . $slug . '`.'
            : $displayName . ' is discoverable, but headless credential setup is not fully supported yet.',
        'mcp_setup_summary' => $cliRuntimeSupported
            ? 'Expose ' . $displayName . ' to MCP clients with `kosmokrator mcp:serve --integration=' . $slug . '`.'
            : $displayName . ' is not currently exposed through the local MCP gateway runtime.',
    ];
}

function humanizeSlug(string $slug): string
{
    $words = preg_split('/[-_]+/', $slug) ?: [];
    $known = [
        'api' => 'API',
        'apod' => 'APOD',
        'aws' => 'AWS',
        'cms' => 'CMS',
        'crm' => 'CRM',
        'dfy' => 'DFY',
        'dns' => 'DNS',
        'esp' => 'ESP',
        'id' => 'ID',
        'mrr' => 'MRR',
        'nasa' => 'NASA',
        'oauth' => 'OAuth',
        'pdf' => 'PDF',
        'png' => 'PNG',
        'seo' => 'SEO',
        'sms' => 'SMS',
        'url' => 'URL',
        'uuid' => 'UUID',
    ];

    return implode(' ', array_map(
        fn ($word) => $known[strtolower($word)] ?? ucfirst(strtolower($word)),
        array_filter($words, fn ($word) => $word !== '')
    ));
}

function normalizeRouteSlug(string $slug): string
{
    $slug = strtolower(str_replace('_', '-', $slug));
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug) ?? $slug;
    $slug = preg_replace('/-+/', '-', $slug) ?? $slug;

    return trim($slug, '-');
}

function inferToolType(string $toolSlug, string $toolName = ''): string
{
    $subject = strtolower($toolSlug . ' ' . $toolName);
    $writePrefixes = [
        'activate', 'add', 'archive', 'assign', 'bulk_add', 'bulk_assign', 'bulk_delete',
        'cancel', 'change', 'create', 'delete', 'disable', 'duplicate', 'enable',
        'forward', 'mark', 'merge', 'move', 'pause', 'remove', 'reply', 'resume',
        'run', 'send', 'submit', 'test', 'toggle', 'update', 'verify', 'warmup',
    ];

    foreach ($writePrefixes as $prefix) {
        if (preg_match('/(^|_)' . preg_quote($prefix, '/') . '(_|$)/', $subject)) {
            return 'write';
        }
    }

    return 'read';
}

function credentialKeys(array $credentials): array
{
    return array_values(array_filter(array_map(
        fn ($field) => is_array($field) ? ($field['key'] ?? null) : null,
        $credentials
    )));
}

function deepMerge(array $base, array $override): array
{
    foreach ($override as $key => $value) {
        if (is_array($value) && isset($base[$key]) && is_array($base[$key]) && array_is_list($value) === false) {
            $base[$key] = deepMerge($base[$key], $value);
            continue;
        }

        $base[$key] = $value;
    }

    return $base;
}

function fieldValues(array $fields, string $key): array
{
    $values = [];
    foreach ($fields as $field) {
        if (is_array($field) && array_key_exists($key, $field)) {
            $values[] = $field[$key];
        }
    }

    return $values;
}

function inferIntegrationCapabilities(
    string $authType,
    array $credentials,
    array $configSchema,
    string $source,
    string $pkgSlug,
    string $category,
    bool $hasTriggers,
    array $explicitCapabilities = [],
): array {
    $keys = array_values(array_unique(array_map(
        'strtolower',
        array_merge(credentialKeys($credentials), fieldValues($configSchema, 'key'))
    )));
    $types = array_values(array_unique(array_map(
        'strtolower',
        array_merge(fieldValues($credentials, 'type'), fieldValues($configSchema, 'type'))
    )));
    $hints = strtolower(implode(' ', array_map('cleanText', fieldValues($configSchema, 'hint'))));

    $hasOauthConnect = in_array('oauth_connect', $types, true);
    $hasAccessToken = in_array('access_token', $keys, true);
    $hasRefreshToken = in_array('refresh_token', $keys, true) || str_contains($source, 'refresh_token') || str_contains($source, 'refreshToken');
    if ($pkgSlug === 'google' && $hasOauthConnect) {
        $hasRefreshToken = true;
        foreach (['refresh_token', 'expires_at'] as $googleTokenKey) {
            if (!in_array($googleTokenKey, $keys, true)) {
                $keys[] = $googleTokenKey;
            }
        }
    }
    $hasClientId = in_array('client_id', $keys, true);
    $hasClientSecret = in_array('client_secret', $keys, true);
    $hasPassword = in_array('password', $keys, true) || in_array('password', $types, true);
    $hasUserKey = in_array('username', $keys, true) || in_array('email', $keys, true) || in_array('user', $keys, true);
    $hasTokenKey = false;
    foreach ($keys as $key) {
        if (str_contains($key, 'token')) {
            $hasTokenKey = true;
            break;
        }
    }

    $runtimeRequirements = [];
    $setupFlows = ['manual_secret'];
    $strategy = 'api_key';
    $credentialMode = 'secret';
    $requiresBrowser = false;
    $refreshable = false;
    $webSetup = true;
    $webRuntime = true;
    $cliSetup = true;
    $cliRuntime = true;
    $webSetupMode = 'manual_secret';
    $cliSetupMode = 'manual_secret';
    $notes = [];

    if (empty($credentials) && empty($configSchema)) {
        $strategy = 'none';
        $credentialMode = 'none';
        $setupFlows = ['none'];
        $webSetupMode = 'none';
        $cliSetupMode = 'none';
    } elseif ($hasOauthConnect) {
        $strategy = 'oauth2_authorization_code';
        $credentialMode = 'stored_token';
        $setupFlows = ['web_redirect'];
        $requiresBrowser = true;
        $refreshable = $hasRefreshToken;
        $cliSetup = false;
        $cliRuntime = $hasAccessToken;
        $webSetupMode = 'web_redirect';
        $cliSetupMode = 'unsupported';
        $notes[] = 'Setup requires a browser redirect callback. CLI can run only after tokens are already stored.';

        if ($pkgSlug === 'google') {
            $setupFlows = ['web_redirect', 'local_redirect', 'device_code'];
            $cliSetup = true;
            $cliSetupMode = 'local_redirect_or_device_code';
            $notes = [
                'Web hosts use the registered OAuth redirect callback.',
                'CLI hosts can support Google OAuth with a desktop loopback redirect; device-code setup is possible where scopes allow it.',
                'CLI runtime works with stored access and refresh tokens.',
            ];
        }
    } elseif ($hasAccessToken) {
        $strategy = str_contains($hints, 'oauth') ? 'oauth2_manual_token' : 'bearer_token';
        $credentialMode = 'stored_token';
        $setupFlows = ['manual_token'];
        $webSetupMode = 'manual_token';
        $cliSetupMode = 'manual_token';
        $refreshable = $hasRefreshToken;
        if ($strategy === 'oauth2_manual_token') {
            $notes[] = 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.';
        }
    } elseif ($hasClientId && $hasClientSecret) {
        $strategy = 'oauth2_client_credentials';
        $credentialMode = 'client_credentials';
        $setupFlows = ['client_credentials'];
        $webSetupMode = 'client_credentials';
        $cliSetupMode = 'client_credentials';
    } elseif ($hasPassword && $hasUserKey) {
        $strategy = 'basic';
        $credentialMode = 'username_password';
    } elseif ($hasTokenKey || $authType === 'api_token') {
        $strategy = 'api_token';
        $credentialMode = 'secret';
    } elseif ($authType === 'none') {
        $strategy = 'none';
        $credentialMode = 'none';
        $setupFlows = ['none'];
        $webSetupMode = 'none';
        $cliSetupMode = 'none';
    }

    $renderingRequirements = [
        'mermaid' => [['type' => 'binary', 'name' => 'mmdc', 'description' => 'Mermaid CLI is required to render diagrams.']],
        'plantuml' => [['type' => 'binary', 'name' => 'java', 'description' => 'Java is required to run PlantUML.']],
        'typst' => [['type' => 'binary', 'name' => 'typst', 'description' => 'Typst CLI is required to render PDFs.']],
        'vegalite' => [['type' => 'binary', 'name' => 'node', 'description' => 'Node.js is required to render Vega-Lite charts.']],
    ];

    if (isset($renderingRequirements[$pkgSlug])) {
        $runtimeRequirements = $renderingRequirements[$pkgSlug];
        $notes[] = 'Runtime depends on local rendering binaries being installed in the host environment.';
    } elseif ($category === 'rendering') {
        $notes[] = 'Rendering integrations may require host-specific local runtime dependencies.';
    }

    if ($hasTriggers) {
        $notes[] = 'Triggers require a web-reachable host endpoint even if tool runtime works in CLI.';
    }

    $capabilities = [
        'auth' => [
            'strategy' => $strategy,
            'legacy_auth_type' => $authType,
            'credential_mode' => $credentialMode,
            'setup_flows' => $setupFlows,
            'requires_browser_for_setup' => $requiresBrowser,
            'refreshable' => $refreshable,
            'token_keys' => array_values(array_intersect($keys, ['access_token', 'refresh_token', 'expires_at'])),
            'confidence' => empty($explicitCapabilities) ? 'inferred' : 'explicit',
            'notes' => $notes,
        ],
        'host_availability' => [
            'web' => [
                'setup_supported' => $webSetup,
                'runtime_supported' => $webRuntime,
                'setup_mode' => $webSetupMode,
            ],
            'cli' => [
                'setup_supported' => $cliSetup,
                'runtime_supported' => $cliRuntime,
                'setup_mode' => $cliSetupMode,
                'runtime_mode' => $cliRuntime && !$cliSetup && $hasOauthConnect ? 'stored_credentials_only' : 'normal',
            ],
            'mcp_gateway' => [
                'setup_supported' => $cliSetup,
                'runtime_supported' => $cliRuntime,
                'setup_mode' => 'kosmokrator_gateway',
                'runtime_mode' => $cliRuntime ? 'kosmokrator_gateway' : 'unsupported',
            ],
        ],
        'runtime_requirements' => $runtimeRequirements,
        'compatibility' => [
            'web_setup_supported' => $webSetup,
            'web_runtime_supported' => $webRuntime,
            'cli_setup_supported' => $cliSetup,
            'cli_runtime_supported' => $cliRuntime,
            'mcp_gateway_supported' => $cliRuntime,
            'lua_supported' => $cliRuntime,
        ],
    ];

    if (!empty($explicitCapabilities)) {
        $capabilities = deepMerge($capabilities, $explicitCapabilities);
        $capabilities['auth']['confidence'] = 'explicit';
    }

    $capabilities['summary'] = summarizeCapabilities($capabilities);

    return $capabilities;
}

function summarizeCapabilities(array $capabilities): string
{
    $auth = $capabilities['auth']['strategy'] ?? 'unknown';
    $webSetup = !empty($capabilities['host_availability']['web']['setup_supported']);
    $cliSetup = !empty($capabilities['host_availability']['cli']['setup_supported']);
    $cliRuntime = !empty($capabilities['host_availability']['cli']['runtime_supported']);

    if ($auth === 'none') {
        return 'No credentials required; available in web and CLI hosts when runtime dependencies are installed.';
    }

    if ($auth === 'oauth2_authorization_code' && $cliSetup && in_array('local_redirect', $capabilities['auth']['setup_flows'] ?? [], true)) {
        return 'OAuth can be configured in web hosts through redirect and in CLI hosts through local/device authorization; runtime works with stored tokens.';
    }

    if ($auth === 'oauth2_authorization_code' && !$cliSetup && $cliRuntime) {
        return 'OAuth setup requires a web browser redirect, but CLI runtime works after credentials are stored.';
    }

    if ($cliSetup && $cliRuntime && $webSetup) {
        return 'Credentials can be configured manually in web or CLI hosts.';
    }

    if (!$cliSetup && !$cliRuntime) {
        return 'This integration is web-only unless explicit CLI credentials are provided by the host.';
    }

    return 'Host compatibility depends on the declared setup flow and stored credentials.';
}

function fallbackIntegrationMeta(string $appName): array
{
    $fallbacks = [
        'celestial' => [
            'name' => 'Celestial',
            'category' => 'data',
            'docs_url' => 'https://aa.usno.navy.mil/data',
            'badge' => 'verified',
        ],
        'exchangerate' => [
            'name' => 'ExchangeRate',
            'category' => 'data',
            'docs_url' => 'https://www.exchangerate-api.com/docs/overview',
            'badge' => 'verified',
        ],
        'hackernews' => [
            'name' => 'Hacker News',
            'category' => 'data',
            'docs_url' => 'https://github.com/HackerNews/API',
            'badge' => 'verified',
        ],
        'mermaid' => [
            'name' => 'Mermaid',
            'category' => 'rendering',
            'docs_url' => 'https://mermaid.js.org/intro/',
            'badge' => 'verified',
        ],
        'nasa' => [
            'name' => 'NASA',
            'category' => 'data',
            'docs_url' => 'https://api.nasa.gov/',
            'badge' => 'verified',
        ],
        'plantuml' => [
            'name' => 'PlantUML',
            'category' => 'rendering',
            'docs_url' => 'https://plantuml.com/',
            'badge' => 'verified',
        ],
        'recaptcha' => [
            'name' => 'reCAPTCHA',
            'category' => 'authentication',
            'docs_url' => 'https://developers.google.com/recaptcha',
            'badge' => 'verified',
        ],
        'smartsheet' => [
            'name' => 'Smartsheet',
            'category' => 'productivity',
            'docs_url' => 'https://developers.smartsheet.com/api/smartsheet/openapi',
            'badge' => 'verified',
            'logo' => 'simple-icons:smartsheet',
        ],
        'typst' => [
            'name' => 'Typst',
            'category' => 'rendering',
            'docs_url' => 'https://typst.app/docs/',
            'badge' => 'verified',
        ],
        'vegalite' => [
            'name' => 'Vega-Lite',
            'category' => 'rendering',
            'docs_url' => 'https://vega.github.io/vega-lite/docs/',
            'badge' => 'verified',
        ],
        'worldbank' => [
            'name' => 'World Bank',
            'category' => 'data',
            'docs_url' => 'https://datahelpdesk.worldbank.org/knowledgebase/topics/125589',
            'badge' => 'verified',
        ],
    ];

    return $fallbacks[$appName] ?? [];
}

function generateLuaDocs(string $displayName, string $appName, array $tools): string
{
    if (empty($tools)) {
        return '';
    }

    $lines = [
        '# ' . $displayName . ' — Lua API Reference',
        '',
        'This reference was generated from tool metadata because no package Lua docs file exists yet.',
        '',
    ];

    foreach ($tools as $tool) {
        $lines[] = '## ' . $tool['function_name'];
        $lines[] = '';
        $description = $tool['description'] ?: ($tool['short_description'] ?: $tool['name']);
        $lines[] = cleanText($description);
        $lines[] = '';

        $parameters = $tool['parameters'];
        if (is_array($parameters) && !empty($parameters)) {
            $lines[] = '### Parameters';
            $lines[] = '';
            $lines[] = '| Name | Type | Required | Description |';
            $lines[] = '|------|------|----------|-------------|';
            foreach ($parameters as $name => $schema) {
                if (!is_array($schema)) {
                    continue;
                }
                $type = $schema['type'] ?? 'mixed';
                $required = !empty($schema['required']) ? 'yes' : 'no';
                $paramDescription = str_replace('|', '\\|', cleanText($schema['description'] ?? ''));
                $lines[] = '| `' . $name . '` | ' . $type . ' | ' . $required . ' | ' . $paramDescription . ' |';
            }
            $lines[] = '';
        } else {
            $lines[] = '### Parameters';
            $lines[] = '';
            $lines[] = 'No parameters are documented in source metadata.';
            $lines[] = '';
        }

        $lines[] = '### Example';
        $lines[] = '';
        $lines[] = '```lua';
        $lines[] = 'local result = app.integrations.' . str_replace('-', '_', $appName) . '.' . $tool['function_name'] . '({})';
        $lines[] = '```';
        $lines[] = '';
        $lines[] = '---';
        $lines[] = '';
    }

    return trim(implode("\n", $lines));
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
    if (empty($toolDefs)) {
        $toolDefs = extractImportedToolClasses($source);
    }
    $credFields = extractReturnArray($source, 'credentialFields') ?? [];
    $configSchema = extractReturnArray($source, 'configSchema') ?? [];
    $validationRules = extractReturnArray($source, 'validationRules') ?? [];
    $explicitCapabilities = extractReturnArray($source, 'capabilities')
        ?? extractReturnArray($source, 'integrationCapabilities')
        ?? [];

    $integrationMeta = array_merge(
        fallbackIntegrationMeta($appName ?? ''),
        extractReturnArray($source, 'integrationMeta') ?? []
    );

    if (($integrationMeta['catalog_visibility'] ?? 'public') === 'hidden') {
        continue;
    }

    $triggerDefs = [];
    if (sourceImplements($source, 'HasTriggers')) {
        $triggerDefs = extractReturnArray($source, 'triggers') ?? [];
    }

    $composer = readComposerJson($pkgDir);
    $luaDocs = readLuaDocs($pkgDir);
    $readme = readReadme($pkgDir);

    // --- Tool-level data ---

    $tools = [];
    foreach ($toolDefs as $toolSlug => $toolMeta) {
        $toolClass = null;
        $providerToolName = '';
        $providerToolType = null;
        $providerToolIcon = '';
        $providerToolDescription = '';

        if (is_array($toolMeta)) {
            $toolClass = $toolMeta['class'] ?? null;
            $providerToolName = $toolMeta['name'] ?? '';
            $providerToolType = $toolMeta['type'] ?? null;
            $providerToolIcon = $toolMeta['icon'] ?? '';
            $providerToolDescription = $toolMeta['description'] ?? '';
        } elseif (is_string($toolMeta)) {
            $toolClass = $toolMeta;
        }

        if ($toolClass === null) {
            continue;
        }

        // Derive tool file path from FQCN
        $toolShortName = basename(str_replace('\\', '/', $toolClass));
        $toolFile = $pkgDir . '/src/Tools/' . $toolShortName . '.php';

        $actualToolSlug = is_string($toolSlug) ? $toolSlug : '';
        $toolDescription = '';
        $toolParameters = [];
        $toolSourceExists = file_exists($toolFile);

        if ($toolSourceExists) {
            $toolSource = file_get_contents($toolFile);

            $nameValue = extractReturnString($toolSource, 'name');
            if ($nameValue !== null) {
                $actualToolSlug = $nameValue;
            }

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

        if (empty($toolDescription) && $providerToolDescription !== '') {
            $toolDescription = $providerToolDescription;
        }

        if (empty($toolParameters) && is_array($toolMeta) && isset($toolMeta['parameters']) && is_array($toolMeta['parameters'])) {
            $toolParameters = $toolMeta['parameters'];
        }

        if ($actualToolSlug === '') {
            $actualToolSlug = is_string($toolSlug) ? normalizeRouteSlug($toolSlug) : normalizeRouteSlug($toolShortName);
        }

        $toolName = $providerToolName !== '' ? $providerToolName : humanizeSlug($actualToolSlug);
        $toolType = $providerToolType ?? inferToolType($actualToolSlug, $toolName);

        $tools[] = [
            'slug' => $actualToolSlug,
            'function_name' => $actualToolSlug,
            'name' => $toolName,
            'type' => $toolType,
            'icon' => $providerToolIcon,
            'short_description' => $providerToolDescription,
            'description' => $toolDescription,
            'parameters' => $toolParameters,
            'parameter_count' => is_array($toolParameters) ? count($toolParameters) : 0,
            'source_available' => $toolSourceExists,
            'source_file' => $toolSourceExists ? 'packages/' . $pkgSlug . '/src/Tools/' . $toolShortName . '.php' : null,
            'operation_id' => is_array($toolMeta) ? ($toolMeta['operation_id'] ?? null) : null,
            'operation' => is_array($toolMeta) ? ($toolMeta['operation'] ?? null) : null,
            'auth_modes' => is_array($toolMeta) ? ($toolMeta['auth_modes'] ?? []) : [],
            'required_scopes' => is_array($toolMeta) ? ($toolMeta['required_scopes'] ?? []) : [],
            'required_access_tier' => is_array($toolMeta) ? ($toolMeta['required_access_tier'] ?? null) : null,
            'runtime_mode' => is_array($toolMeta) ? ($toolMeta['runtime_mode'] ?? 'request_response') : 'request_response',
            'destructive' => is_array($toolMeta) ? (bool) ($toolMeta['destructive'] ?? false) : false,
            'billing_sensitive' => is_array($toolMeta) ? (bool) ($toolMeta['billing_sensitive'] ?? false) : false,
            'docs_url' => is_array($toolMeta) ? ($toolMeta['docs_url'] ?? null) : null,
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
            $normalized = [
                'key' => $field['key'] ?? '',
                'type' => $field['type'] ?? 'string',
                'label' => $field['label'] ?? '',
                'required' => $field['required'] ?? false,
            ];

            foreach (['placeholder', 'hint', 'default', 'options', 'item_icon', 'item_placeholder'] as $optionalKey) {
                if (array_key_exists($optionalKey, $field)) {
                    $normalized[$optionalKey] = $field[$optionalKey];
                }
            }

            $credentials[] = $normalized;
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

    $toolTypes = array_count_values(array_map(fn ($tool) => $tool['type'], $tools));
    $missingToolFiles = array_values(array_map(
        fn ($tool) => $tool['slug'],
        array_filter($tools, fn ($tool) => empty($tool['source_available']))
    ));
    $packageName = $composer['name'] ?? ('opencompanyapp/integration-' . $pkgSlug);
    $displayName = $integrationMeta['name'] ?? humanizeSlug($appName);
    $description = $integrationMeta['description'] ?? $appMeta['description'] ?? $composer['description'] ?? '';
    $shortDescription = $appMeta['description'] ?? truncateText($description, 90);
    $authType = inferAuthType($credFields);
    $category = $integrationMeta['category'] ?? 'other';
    $capabilities = inferIntegrationCapabilities(
        authType: $authType,
        credentials: $credentials,
        configSchema: $configSchema,
        source: $source,
        pkgSlug: $pkgSlug,
        category: $category,
        hasTriggers: !empty($triggerDefs),
        explicitCapabilities: $explicitCapabilities,
    );
    $headlessSetup = buildHeadlessSetupMetadata($appName, $displayName, $credentials, $capabilities);
    $supportsMultiAccount = str_contains($source, '$context[\'account\']')
        || str_contains($source, '$context["account"]')
        || str_contains($source, 'context[\'account\']')
        || str_contains($source, 'context["account"]');
    $installCommand = $packageName !== null ? 'composer require ' . $packageName : null;
    $metaDescription = truncateText('Connect ' . $displayName . ' to AI agents to ' . lcfirst(rtrim(cleanText($description), '.')) . '.', 155);
    $icon = $integrationMeta['icon'] ?? $appMeta['icon'] ?? '';
    $logo = $integrationMeta['logo'] ?? $appMeta['logo'] ?? $icon;
    $docsUrl = $integrationMeta['docs_url'] ?? null;
    $luaDocsGenerated = false;
    if ($luaDocs === '') {
        $luaDocs = generateLuaDocs($displayName, $appName, $tools);
        $luaDocsGenerated = $luaDocs !== '';
    }

    // --- Assemble ---

    $integrations[] = [
        'slug' => $appName,
        'package' => $pkgSlug,
        'route_slug' => normalizeRouteSlug($appName),
        'name' => $displayName,
        'description' => $description,
        'short_description' => $shortDescription,
        'label' => $appMeta['label'] ?? '',
        'category' => $category,
        'badge' => $integrationMeta['badge'] ?? 'verified',
        'icon' => $icon,
        'logo' => $logo,
        'docs_url' => $docsUrl,
        'auth_type' => $authType,
        'auth_strategy' => $capabilities['auth']['strategy'] ?? null,
        'auth' => $capabilities['auth'],
        'auth_summary' => $capabilities['summary'],
        'host_availability' => $capabilities['host_availability'],
        'runtime_requirements' => $capabilities['runtime_requirements'],
        'compatibility' => $capabilities['compatibility'],
        'compatibility_summary' => $capabilities['summary'],
        'cli_setup_supported' => $capabilities['compatibility']['cli_setup_supported'] ?? null,
        'cli_runtime_supported' => $capabilities['compatibility']['cli_runtime_supported'] ?? null,
        'keywords' => $composer['keywords'] ?? [],
        'composer_description' => $composer['description'] ?? null,
        'package_meta' => [
            'composer_name' => $packageName,
            'directory' => 'packages/' . $pkgSlug,
            'namespace' => $composer['namespace'] ?? null,
            'service_providers' => $composer['providers'] ?? [],
            'install_command' => $installCommand,
            'license' => $composer['license'] ?? null,
            'authors' => array_values(array_map(
                fn ($author) => is_array($author) ? ($author['name'] ?? null) : null,
                $composer['authors'] ?? []
            )),
            'requires' => $composer['require'] ?? [],
            'replaces' => $composer['replace'] ?? [],
            'type' => $composer['type'] ?? null,
        ],
        'seo' => [
            'canonical_slug' => normalizeRouteSlug($appName),
            'canonical_url' => '/integrations/' . normalizeRouteSlug($appName),
            'page_title' => $displayName . ' Integration for AI Agents',
            'meta_description' => $metaDescription,
            'h1' => $displayName . ' Integration',
            'og_title' => $displayName . ' Integration for AI Agents',
            'og_description' => $metaDescription,
            'og_image' => null,
            'auth_summary' => $capabilities['summary'],
            'auth_strategy' => $capabilities['auth']['strategy'] ?? null,
            'cli_setup_supported' => $capabilities['compatibility']['cli_setup_supported'] ?? null,
            'cli_runtime_supported' => $capabilities['compatibility']['cli_runtime_supported'] ?? null,
            'web_setup_supported' => $capabilities['compatibility']['web_setup_supported'] ?? null,
            'web_runtime_supported' => $capabilities['compatibility']['web_runtime_supported'] ?? null,
            'mcp_gateway_supported' => $capabilities['compatibility']['mcp_gateway_supported'] ?? null,
            'lua_supported' => $capabilities['compatibility']['lua_supported'] ?? null,
            'cli_setup_summary' => $headlessSetup['cli_setup_summary'],
            'mcp_setup_summary' => $headlessSetup['mcp_setup_summary'],
            'keywords' => [
                strtolower($displayName) . ' cli',
                strtolower($displayName) . ' mcp',
                strtolower($displayName) . ' lua',
                strtolower($displayName) . ' integration',
                strtolower($displayName) . ' agent tools',
            ],
        ],
        'readme' => $readme,
        'tool_count' => count($tools),
        'read_tool_count' => $toolTypes['read'] ?? 0,
        'write_tool_count' => $toolTypes['write'] ?? 0,
        'action_tool_count' => $toolTypes['action'] ?? 0,
        'trigger_count' => count($triggers),
        'has_triggers' => !empty($triggerDefs),
        'tools' => $tools,
        'triggers' => $triggers,
        'credentials' => $credentials,
        'credential_keys' => credentialKeys($credentials),
        'setup' => array_merge([
            'auth_type' => $authType,
            'auth_strategy' => $capabilities['auth']['strategy'] ?? null,
            'auth' => $capabilities['auth'],
            'host_availability' => $capabilities['host_availability'],
            'supports_multi_account' => $supportsMultiAccount,
            'credentials' => $credentials,
            'config_schema' => $configSchema,
            'validation_rules' => $validationRules,
        ], $headlessSetup),
        'quality' => [
            'has_lua_docs' => $luaDocs !== '',
            'has_lua_docs_file' => !$luaDocsGenerated && $luaDocs !== '',
            'lua_docs_generated' => $luaDocsGenerated,
            'has_readme' => $readme['exists'] ?? false,
            'has_docs_url' => !empty($docsUrl),
            'has_logo' => !empty($logo),
            'has_config_schema' => !empty($configSchema),
            'missing_tool_files' => $missingToolFiles,
            'missing_tool_file_count' => count($missingToolFiles),
        ],
        'related_integrations' => [],
        'lua_docs' => $luaDocs !== '' ? $luaDocs : null,
    ];
}

// Resolve route collisions and add lightweight related integration suggestions.
$routeCounts = array_count_values(array_map(fn ($integration) => $integration['route_slug'], $integrations));
$categoryBuckets = [];
foreach ($integrations as $integration) {
    $categoryBuckets[$integration['category']][] = [
        'slug' => $integration['slug'],
        'name' => $integration['name'],
        'route_slug' => $integration['route_slug'],
    ];
}

foreach ($integrations as &$integration) {
    $routeSlug = $integration['route_slug'];
    if (($routeCounts[$routeSlug] ?? 0) > 1 && $integration['package'] !== $routeSlug) {
        $routeSlug = $integration['package'] . '/' . $routeSlug;
    }

    $integration['route_slug'] = $routeSlug;
    $integration['seo']['canonical_slug'] = $routeSlug;
    $integration['seo']['canonical_url'] = '/integrations/' . $routeSlug;

    $related = [];
    foreach ($categoryBuckets[$integration['category']] ?? [] as $candidate) {
        if ($candidate['slug'] === $integration['slug'] && $candidate['route_slug'] === normalizeRouteSlug($integration['slug'])) {
            continue;
        }
        if ($candidate['slug'] === $integration['slug'] && $candidate['route_slug'] === $integration['route_slug']) {
            continue;
        }
        $related[] = $candidate;
        if (count($related) >= 6) {
            break;
        }
    }
    $integration['related_integrations'] = $related;
}
unset($integration);

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
