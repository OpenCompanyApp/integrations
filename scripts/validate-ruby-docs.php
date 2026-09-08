<?php

declare(strict_types=1);

/** Compile every active Ruby example with the pinned guest, never execute it. */
require $argv[1];
$client = new Bowerbird\RubyEngine\Client($argv[2]);
$count = 0;
$failures = 0;
foreach (glob(dirname(__DIR__).'/packages/*/script-docs/*.md') as $file) {
    preg_match_all('/```ruby\R(.*?)```/s', file_get_contents($file), $blocks);
    foreach ($blocks[1] as $index => $source) {
        $result = $client->execute($source, validateOnly: true, filename: 'documentation.rb');
        $count++;
        if ($result->error !== null) {
            $failures++;
            echo basename(dirname($file, 2)).':'.($index + 1).' '.json_encode($result->error, JSON_THROW_ON_ERROR)."\n";
        }
        if ($count % 250 === 0) echo "Compiled {$count} examples; {$failures} failures\n";
    }
}
echo "Compiled {$count} examples; {$failures} failures\n";
exit($failures === 0 ? 0 : 1);
