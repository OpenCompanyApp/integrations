<?php

namespace OpenCompany\Integrations\Osv\Tools;

/**
 * Query vulnerabilities for multiple package versions or commits.
 */
class OsvQueryBatch extends AbstractOsvTool
{
    protected const NAME = 'osv_query_batch';
    protected const DESCRIPTION = 'Query OSV vulnerabilities for multiple packages or commits. The response order matches the input query order.';
    protected const METHOD = 'queryBatch';
    protected const REQUIRED = ['queries'];
    protected const PARAMETERS = [
        'queries' => ['type' => 'array', 'required' => true, 'description' => 'Up to 1000 OSV query objects.', 'items' => ['type' => 'object']],
    ];
}
