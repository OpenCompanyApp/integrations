<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List instalment schedules.
 *
 * Maps to the official GoCardless endpoint GET /instalment_schedules.
 */
class GoCardlessListInstalmentSchedule extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_instalment_schedule';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your instalment schedules.

Official GoCardless endpoint: GET /instalment_schedules.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/instalment_schedules';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
