<?php

declare(strict_types=1);
use QuickJS\Sandbox;

/**
 * Compile every supplementary Code Mode example with the production engine.
 *
 * This validator intentionally compiles without invoking examples: package docs
 * can describe external writes, while validation must remain deterministic and
 * side-effect free. Runtime/bridge behavior is covered in the host test suite.
 */
if (! extension_loaded('quickjs_sandbox')) {
    fwrite(STDERR, "The quickjs_sandbox PHP extension is required.\n");
    exit(2);
}

$root = dirname(__DIR__);
$files = glob($root.'/packages/*/script-docs/*.md') ?: [];
$failures = [];
$blocks = 0;

foreach ($files as $file) {
    $markdown = file_get_contents($file);
    if ($markdown === false) {
        $failures[] = "{$file}: unreadable";

        continue;
    }

    if (preg_match('/```(?:lua|luau)\b|\blua_(?:exec|read_doc|search_docs|list_docs)\b/i', $markdown)) {
        $failures[] = "{$file}: contains a retired runtime fence or tool name";
    }

    preg_match_all('/^```(?:js|javascript)\s*\R(.*?)^```\s*$/msi', $markdown, $matches, PREG_SET_ORDER);
    foreach ($matches as $index => $match) {
        $blocks++;
        try {
            $sandbox = new Sandbox(
                memory_limit: 32 * 1024 * 1024,
                cpu_limit: 5.0,
                stack_limit: 512 * 1024,
            );
            $sandbox->load($match[1], basename($file).':'.($index + 1));
        } catch (Throwable $exception) {
            $relative = substr($file, strlen($root) + 1);
            $failures[] = "{$relative} block ".($index + 1).": {$exception->getMessage()}";
        }
    }
}

if ($failures !== []) {
    fwrite(STDERR, implode("\n", $failures)."\n");
    fwrite(STDERR, sprintf("Failed with %d issue(s) across %d block(s).\n", count($failures), $blocks));
    exit(1);
}

fwrite(STDOUT, sprintf("Validated %d JavaScript block(s) across %d documentation file(s).\n", $blocks, count($files)));
