<?php

namespace OpenCompany\Integrations\Osv\Tools;

/**
 * Query vulnerabilities for one package version, purl, or git commit.
 */
class OsvQuery extends AbstractOsvTool
{
    protected const NAME = 'osv_query';
    protected const DESCRIPTION = 'Query OSV vulnerabilities for one package version, package URL, or git commit hash.';
    protected const METHOD = 'query';
    protected const PARAMETERS = [
        'commit' => ['type' => 'string', 'required' => false, 'description' => 'Git commit hash. Do not combine with version.'],
        'version' => ['type' => 'string', 'required' => false, 'description' => 'Package version. Do not combine with commit or a versioned purl.'],
        'package_name' => ['type' => 'string', 'required' => false, 'description' => 'Package name in its ecosystem, such as jinja2.'],
        'ecosystem' => ['type' => 'string', 'required' => false, 'description' => 'Case-sensitive OSV ecosystem, such as PyPI, npm, Go, Maven, crates.io, RubyGems, Packagist, or GIT.'],
        'purl' => ['type' => 'string', 'required' => false, 'description' => 'Package URL. Do not combine with package_name or ecosystem.'],
        'page_token' => ['type' => 'string', 'required' => false, 'description' => 'Pagination token from next_page_token.'],
        'payload' => ['type' => 'object', 'required' => false, 'description' => 'Raw OSV query object.'],
    ];
}
