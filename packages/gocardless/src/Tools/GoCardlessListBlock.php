<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List multiple blocks.
 *
 * Maps to the official GoCardless endpoint GET /blocks.
 */
class GoCardlessListBlock extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_block';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your blocks.

Official GoCardless endpoint: GET /blocks.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/blocks';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
