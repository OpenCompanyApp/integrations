<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List verification details.
 *
 * Maps to the official GoCardless endpoint GET /verification_details.
 */
class GoCardlessListVerificationDetail extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_verification_detail';
    protected const DESCRIPTION = 'Returns a list of verification details belonging to a creditor.

Official GoCardless endpoint: GET /verification_details.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/verification_details';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
