<?php

namespace OpenCompany\Integrations\Osv\Tools;

/**
 * Experimentally determine likely C/C++ package versions from file hashes.
 */
class OsvDetermineVersion extends AbstractOsvTool
{
    protected const NAME = 'osv_determine_version';
    protected const DESCRIPTION = 'Experimentally identify likely C/C++ library versions from relative file paths and base64-encoded MD5 hash bytes.';
    protected const METHOD = 'determineVersion';
    protected const REQUIRED = ['file_hashes'];
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => false, 'description' => 'Optional package-name hint.'],
        'file_hashes' => ['type' => 'array', 'required' => true, 'description' => 'File hashes with file_path and base64 MD5 hash bytes.', 'items' => ['type' => 'object', 'properties' => ['file_path' => ['type' => 'string'], 'hash' => ['type' => 'string']]]],
        'payload' => ['type' => 'object', 'required' => false, 'description' => 'Raw determineversion payload.'],
    ];
}
